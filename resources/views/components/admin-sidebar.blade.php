<div class="bg-gray-900 text-white w-64 min-h-screen p-6 shadow-2xl">
    <h2 class="text-2xl font-bold mb-8 border-b border-gray-700 pb-4 text-blue-400">ADMIN PANEL</h2>

    <nav class="space-y-4">
        <div>
            <p class="text-gray-500 text-xs uppercase mb-2 font-bold tracking-widest">General</p>
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded transition duration-200">
                <span>📊</span>
                <span>Dashboard Summary</span>
            </a>
        </div>

        <div>
            <p class="text-gray-500 text-xs uppercase mb-2 font-bold tracking-widest">Employees</p>
            <a href="{{ route('admin.employees.index') }}"
                class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded transition duration-200">
                <span>👥</span>
                <span>Employee List</span>
            </a>
            <a href="{{ route('admin.employees.create') }}"
                class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded transition duration-200">
                <span>➕</span>
                <span>Add Employee</span>
            </a>
        </div>

        <div>
            <p class="text-gray-500 text-xs uppercase mb-2 font-bold tracking-widest">Admins</p>
            <a href="{{ route('admin.admins.index') }}"
                class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded transition duration-200">
                <span>🛡️</span>
                <span>Admin List</span>
            </a>
            <a href="{{ route('admin.admins.create') }}"
                class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded transition duration-200">
                <span>🔑</span>
                <span>Add Admin Account</span>
            </a>
        </div>
    </nav>
</div>