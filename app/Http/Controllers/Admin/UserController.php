<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Eager load count dokumen untuk menghindari N+1 problem
        $query->withCount('dokumens');

        // Search functionality
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->has('role') && !empty($request->role)) {
            $query->where('role', $request->role);
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Sort
        $sortField = $request->get('sort_field', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');
        
        // Validate sort field to prevent SQL injection
        $allowedSortFields = ['id', 'name', 'email', 'role', 'is_active', 'created_at', 'dokumens_count'];
        if (!in_array($sortField, $allowedSortFields)) {
            $sortField = 'created_at';
        }
        
        $query->orderBy($sortField, $sortDirection);

        $users = $query->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show form for creating new user.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
 * Store a newly created user.
 */
public function store(Request $request)
{
    // Debug: lihat data yang dikirim
    \Log::info('Create user request:', $request->all());

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()],
        'role' => 'required|in:admin,user',
        'is_active' => 'nullable|boolean'
    ]);

    if ($validator->fails()) {
        \Log::error('Validation failed:', $validator->errors()->toArray());
        
        return redirect()->back()
            ->withErrors($validator)
            ->withInput()
            ->with('error', 'Validasi gagal. Periksa kembali form Anda.');
    }

    try {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_active' => $request->has('is_active') ? true : false,
        ];

        \Log::info('Attempting to create user with data:', $data);

        $user = User::create($data);

        \Log::info('User created successfully:', ['id' => $user->id, 'email' => $user->email]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User "' . $user->name . '" berhasil ditambahkan.');

    } catch (\Exception $e) {
        \Log::error('Error creating user: ' . $e->getMessage());
        
        return redirect()->back()
            ->withInput()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}

    /**
     * Show form for editing user.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
 * Update the specified user.
 */
public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'role' => 'required|in:admin,user',
        'is_active' => 'nullable|boolean', // Perbaiki validasi
        'password' => $request->filled('password') ? ['confirmed', Password::min(8)->mixedCase()->numbers()] : '',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $data = [
        'name' => $request->name,
        'email' => $request->email,
        'role' => $request->role,
        'is_active' => $request->has('is_active') ? true : false, // Ubah 1/0 jadi true/false
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    try {
        $user->update($data);
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User "' . $user->name . '" berhasil diperbarui.');
            
    } catch (\Exception $e) {
        \Log::error('Error updating user: ' . $e->getMessage());
        
        return redirect()->back()
            ->withInput()
            ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
    /**
     * Display the specified user.
     */
    public function show($id)
    {
        $user = User::withCount('dokumens')
                    ->with(['dokumens' => function($query) {
                        $query->latest()->limit(10);
                    }])
                    ->findOrFail($id);
        
        // Get additional statistics
        $totalStorage = $user->dokumens()
            ->where('jenis_upload', 'file')
            ->sum('file_size');
        
        $documentsByType = $user->dokumens()
            ->selectRaw('jenis_upload, count(*) as total')
            ->groupBy('jenis_upload')
            ->pluck('total', 'jenis_upload')
            ->toArray();
        
        $documentsByMonth = $user->dokumens()
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, count(*) as total')
            ->groupBy('month')
            ->orderBy('month', 'desc')
            ->limit(6)
            ->get();
        
        return view('admin.users.show', compact('user', 'totalStorage', 'documentsByType', 'documentsByMonth'));
    }

    /**
     * Remove the specified user.
     */
    public function destroy($id)
    {
        $user = User::withCount('dokumens')->findOrFail($id);
        
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Check if user has related documents
        if ($user->dokumens_count > 0) {
            return redirect()->route('admin.users.index')
                ->with('error', 'User masih memiliki ' . $user->dokumens_count . ' dokumen terkait. Hapus dokumen terlebih dahulu.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    /**
     * Bulk delete users.
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id'
        ]);

        $count = 0;
        $currentUserId = auth()->id();
        $skippedUsers = [];

        foreach ($request->user_ids as $userId) {
            if ($userId != $currentUserId) {
                $user = User::withCount('dokumens')->find($userId);
                if ($user && $user->dokumens_count == 0) {
                    $user->delete();
                    $count++;
                } else if ($user) {
                    $skippedUsers[] = $user->name;
                }
            }
        }

        $message = "{$count} user berhasil dihapus.";
        if (!empty($skippedUsers)) {
            $message .= " User yang memiliki dokumen tidak dapat dihapus: " . implode(', ', array_slice($skippedUsers, 0, 3));
            if (count($skippedUsers) > 3) {
                $message .= " dan " . (count($skippedUsers) - 3) . " lainnya.";
            }
        }

        return redirect()->route('admin.users.index')
            ->with('success', $message);
    }

    /**
     * Toggle user active status.
     */
    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak dapat mengubah status akun Anda sendiri.'
            ], 403);
        }

        $user->is_active = !$user->is_active;
        $user->save();

        return response()->json([
            'success' => true,
            'is_active' => $user->is_active,
            'message' => 'Status user berhasil diubah menjadi ' . ($user->is_active ? 'Aktif' : 'Nonaktif') . '.'
        ]);
    }

    /**
     * Export users to CSV.
     */
    public function exportCsv()
    {
        $users = User::withCount('dokumens')->get();
        
        $filename = 'users-' . date('Y-m-d-His') . '.csv';
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Add UTF-8 BOM for Excel compatibility
        fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // Add headers
        fputcsv($handle, ['ID', 'Nama', 'Email', 'Role', 'Status', 'Jumlah Dokumen', 'Terdaftar']);
        
        // Add data
        foreach ($users as $user) {
            fputcsv($handle, [
                $user->id,
                $user->name,
                $user->email,
                $user->role === 'admin' ? 'Administrator' : 'User',
                $user->is_active ? 'Aktif' : 'Nonaktif',
                $user->dokumens_count,
                $user->created_at->format('d/m/Y H:i')
            ]);
        }
        
        fclose($handle);
        exit;
    }
}