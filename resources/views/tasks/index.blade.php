<x-app-layout>
    <style>
        .todo-wrap { max-width: 560px; margin: 0 auto; padding: 1.5rem 0; }
        .todo-header h1 { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 600; color: #1a1a1a; margin: 0 0 4px; }
        .todo-header p { font-size: 13px; color: #888; margin: 0 0 1.5rem; }
        .stats-row { display: flex; gap: 10px; margin-bottom: 1.5rem; }
        .stat-card { flex: 1; background: #fff; border: 0.5px solid #e5e5e5; border-radius: 12px; padding: 12px 16px; }
        .stat-card .num { font-size: 22px; font-weight: 500; color: #1a1a1a; }
        .stat-card .lbl { font-size: 12px; color: #888; margin-top: 2px; }
        .progress-bar-wrap { margin-bottom: 1.5rem; }
        .progress-label { display: flex; justify-content: space-between; font-size: 12px; color: #888; margin-bottom: 6px; }
        .progress-bar-bg { background: #e5e5e5; border-radius: 99px; height: 6px; overflow: hidden; }
        .progress-bar-fill { background: #1D9E75; height: 100%; border-radius: 99px; transition: width 0.4s; }
        .add-form { display: flex; gap: 8px; margin-bottom: 1.5rem; }
        .add-form input { flex: 1; padding: 10px 14px; border: 0.5px solid #ddd; border-radius: 8px; font-size: 14px; font-family: 'DM Sans', sans-serif; outline: none; background: #fff; }
        .add-form input:focus { border-color: #1D9E75; box-shadow: 0 0 0 3px rgba(29,158,117,0.12); }
        .add-btn { padding: 10px 20px; background: #1D9E75; color: #fff; border: none; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; }
        .add-btn:hover { background: #0F6E56; }
        .section-label { font-size: 11px; font-weight: 500; color: #aaa; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 8px; margin-top: 1rem; }
        .task-list { display: flex; flex-direction: column; gap: 6px; }
        .task-item { display: flex; align-items: center; gap: 12px; background: #fff; border: 0.5px solid #e5e5e5; border-radius: 12px; padding: 12px 16px; }
        .task-item:hover { border-color: #ccc; }
        .task-item.done { opacity: 0.55; }
        .task-item.done .task-title { text-decoration: line-through; color: #aaa; }
        .task-title { flex: 1; font-size: 14px; color: #1a1a1a; }
        .task-actions { display: flex; gap: 6px; }
        .btn-edit { font-size: 12px; color: #185FA5; background: #E6F1FB; border: none; border-radius: 6px; padding: 4px 10px; cursor: pointer; font-family: 'DM Sans', sans-serif; text-decoration: none; }
        .btn-delete { font-size: 12px; color: #A32D2D; background: #FCEBEB; border: none; border-radius: 6px; padding: 4px 10px; cursor: pointer; font-family: 'DM Sans', sans-serif; }
        .btn-toggle { width: 22px; height: 22px; border-radius: 50%; border: 1.5px solid #ccc; background: none; cursor: pointer; flex-shrink: 0; display: flex; align-items: center; justify-content: center; font-size: 12px; }
        .btn-toggle.checked { background: #1D9E75; border-color: #1D9E75; color: #fff; }
        .flash { background: #EAF3DE; color: #3B6D11; padding: 10px 16px; border-radius: 8px; margin-bottom: 1rem; font-size: 14px; }
        .empty { text-align: center; padding: 2rem; color: #aaa; font-size: 14px; }
    </style>

    <div class="todo-wrap">

        <div class="todo-header">
            <h1>My Tasks</h1>
            <p>{{ now()->format('l, F j Y') }}</p>
        </div>

        @if(session('success'))
            <div class="flash">{{ session('success') }}</div>
        @endif

        @php
            $total = $tasks->count();
            $completed = $tasks->where('is_completed', true)->count();
            $remaining = $total - $completed;
            $percent = $total > 0 ? round(($completed / $total) * 100) : 0;
        @endphp

        <div class="stats-row">
            <div class="stat-card">
                <div class="num">{{ $total }}</div>
                <div class="lbl">Total tasks</div>
            </div>
            <div class="stat-card">
                <div class="num">{{ $completed }}</div>
                <div class="lbl">Completed</div>
            </div>
            <div class="stat-card">
                <div class="num">{{ $remaining }}</div>
                <div class="lbl">Remaining</div>
            </div>
        </div>

        <div class="progress-bar-wrap">
            <div class="progress-label">
                <span>Progress</span>
                <span>{{ $percent }}%</span>
            </div>
            <div class="progress-bar-bg">
                <div class="progress-bar-fill" style="width: {{ $percent }}%"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('tasks.store') }}" class="add-form">
            @csrf
            <input type="text" name="title" placeholder="Add a new task..." required />
            <button type="submit" class="add-btn">+ Add</button>
        </form>

        @if($tasks->where('is_completed', false)->count())
            <div class="section-label">Active</div>
            <div class="task-list">
                @foreach($tasks->where('is_completed', false) as $task)
                    <div class="task-item">
                        <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn-toggle">—</button>
                        </form>
                        <span class="task-title">{{ $task->title }}</span>
                        <div class="task-actions">
                            <a href="{{ route('tasks.edit', $task) }}" class="btn-edit">Edit</a>
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if($tasks->where('is_completed', true)->count())
            <div class="section-label">Completed</div>
            <div class="task-list">
                @foreach($tasks->where('is_completed', true) as $task)
                    <div class="task-item done">
                        <form method="POST" action="{{ route('tasks.toggle', $task) }}">
                            @csrf @method('PATCH')
                            <button type="submit" class="btn-toggle checked">✓</button>
                        </form>
                        <span class="task-title">{{ $task->title }}</span>
                        <div class="task-actions">
                            <form method="POST" action="{{ route('tasks.destroy', $task) }}" style="display:inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        @if($tasks->count() === 0)
            <div class="empty">No tasks yet. Add one above! 👆</div>
        @endif

    </div>
</x-app-layout>