<x-app-layout>
    <style>
        .edit-wrap { max-width: 480px; margin: 3rem auto; padding: 0 1rem; }
        .edit-card { background: #fff; border: 0.5px solid #e5e5e5; border-radius: 16px; padding: 2rem; }
        .edit-card h1 { font-family: 'Playfair Display', serif; font-size: 24px; margin: 0 0 1.5rem; color: #1a1a1a; }
        .edit-input { width: 100%; padding: 10px 14px; border: 0.5px solid #ddd; border-radius: 8px; font-size: 14px; outline: none; box-sizing: border-box; }
        .edit-input:focus { border-color: #1D9E75; box-shadow: 0 0 0 3px rgba(29,158,117,0.12); }
        .btn-row { display: flex; gap: 8px; margin-top: 1rem; }
        .btn-save { padding: 10px 24px; background: #1D9E75; color: #fff; border: none; border-radius: 8px; font-size: 14px; font-weight: 500; cursor: pointer; }
        .btn-save:hover { background: #0F6E56; }
        .btn-cancel { padding: 10px 24px; background: #f5f4f0; color: #555; border: 0.5px solid #ddd; border-radius: 8px; font-size: 14px; cursor: pointer; text-decoration: none; display: inline-block; }
        .error { color: #A32D2D; font-size: 13px; margin-top: 6px; }
    </style>

    <div class="edit-wrap">
        <div class="edit-card">
            <h1>Edit Task</h1>
            <form method="POST" action="{{ route('tasks.update', $task) }}">
                @csrf
                @method('PUT')
                <input
                    type="text"
                    name="title"
                    class="edit-input"
                    value="{{ old('title', $task->title) }}"
                    required
                />
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="btn-row">
                    <button type="submit" class="btn-save">Update</button>
                    <a href="{{ route('tasks.index') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>