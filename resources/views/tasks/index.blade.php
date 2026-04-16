<x-app-layout>

<div class="max-w-3xl mx-auto py-10 px-6">

    <!-- HEADER -->
    <div class="mb-6">
        <h1 class="font-display text-3xl font-semibold">My Tasks</h1>
        <p class="text-sm text-muted">{{ now()->format('l, F j Y') }}</p>
    </div>

    @php
        $total = $tasks->count();
        $completed = $tasks->where('is_completed', true)->count();
        $remaining = $total - $completed;
        $percent = $total > 0 ? round(($completed / $total) * 100) : 0;
    @endphp

    <!-- STATS -->
    <div class="grid grid-cols-3 gap-5 mb-8">

        <div class="bg-white border border-border rounded-xl px-6 py-5 shadow-soft">
            <div class="text-2xl font-semibold">{{ $total }}</div>
            <div class="text-xs text-muted">Total</div>
        </div>

        <div class="bg-white border border-border rounded-xl px-6 py-5 shadow-soft">
            <div class="text-2xl font-semibold">{{ $completed }}</div>
            <div class="text-xs text-muted">Completed</div>
        </div>

        <div class="bg-white border border-border rounded-xl px-6 py-5 shadow-soft">
            <div class="text-2xl font-semibold">{{ $remaining }}</div>
            <div class="text-xs text-muted">Remaining</div>
        </div>

    </div>

    <!-- PROGRESS -->
    <div class="mb-8">
        <div class="flex justify-between text-sm text-muted mb-2">
            <span>Progress</span>
            <span>{{ $percent }}%</span>
        </div>

        <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
            <div class="bg-primary h-full transition-all duration-500"
                 style="width: {{ $percent }}%"></div>
        </div>
    </div>

    <!-- ADD TASK -->
    <form method="POST" action="{{ route('tasks.store') }}" class="flex gap-3 mb-8">
        @csrf

        <input type="text"
               name="title"
               placeholder="Add a new task..."
               class="flex-1 px-4 py-3 border border-[#ddd] rounded-lg text-sm">

        <button class="px-6 py-3 bg-primary text-white rounded-lg">
            + Add
        </button>
    </form>

    <!-- ACTIVE TASKS -->
    <div class="mb-6 text-xs text-muted uppercase">Active</div>

    <div class="flex flex-col gap-3">

        @foreach($tasks->where('is_completed', false) as $task)

        <div class="flex items-center gap-3 bg-white border border-border rounded-xl px-4 py-3 shadow-soft">

            <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                @csrf @method('PATCH')
                <button class="w-5 h-5 border rounded-full">—</button>
            </form>

            <span class="flex-1 text-sm">{{ $task->title }}</span>

            <div class="flex gap-2">
                <a href="{{ route('tasks.edit', $task) }}"
                   class="text-xs bg-blue-100 text-blue-600 px-3 py-1 rounded-md">
                    Edit
                </a>

                <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                    @csrf @method('DELETE')
                    <button class="text-xs bg-red-100 text-red-600 px-3 py-1 rounded-md">
                        Delete
                    </button>
                </form>
            </div>

        </div>

        @endforeach

    </div>

    <!-- COMPLETED -->
    <div class="mt-6 mb-3 text-xs text-muted uppercase">Completed</div>

    <div class="flex flex-col gap-3">

        @foreach($tasks->where('is_completed', true) as $task)

        <div class="flex items-center gap-3 bg-white border border-border rounded-xl px-4 py-3 opacity-60">

            <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                @csrf @method('PATCH')
                <button class="w-5 h-5 bg-primary text-white rounded-full">✓</button>
            </form>

            <span class="flex-1 text-sm line-through text-gray-400">
                {{ $task->title }}
            </span>

            <form method="POST" action="{{ route('tasks.destroy', $task) }}">
                @csrf @method('DELETE')
                <button class="text-xs bg-red-100 text-red-600 px-3 py-1 rounded-md">
                    Delete
                </button>
            </form>

        </div>

        @endforeach

    </div>

</div>

</x-app-layout>