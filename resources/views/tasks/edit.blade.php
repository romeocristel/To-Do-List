<x-app-layout>

<div class="max-w-3xl mx-auto py-10 px-6">

    <h1 class="font-display text-3xl font-semibold mb-6">Edit Task</h1>

    <div class="bg-white border border-border rounded-xl p-6 shadow-soft">

        <form method="POST" action="{{ route('tasks.update', $task) }}" class="flex flex-col gap-4">

            @csrf
            @method('PUT')

            <input type="text"
                   name="title"
                   value="{{ $task->title }}"
                   class="w-full px-4 py-3 border border-[#ddd] rounded-lg">

            <div class="flex justify-between">
                <a href="{{ route('tasks.index') }}" class="text-sm text-muted">
                    Cancel
                </a>

                <button class="px-6 py-3 bg-primary text-white rounded-lg">
                    Save
                </button>
            </div>

        </form>

    </div>

</div>

</x-app-layout>