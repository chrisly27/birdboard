@extends('layouts.app')

    @section('content')

        <header class="flex items-center mb-3 py-4">
            <div class="flex justify-between items-end w-full">

                <p class="text-grey text-sm font-normal">
                    
                    <a href="/projects" class="text-grey text-sm font-normal no-underline">My Projects</a> / {{ $project->title }}

                </p>

                <a href="{{ $project->path() . '/edit' }}" class="button">Edit Project</a>
            </div>

        </header>

        <main>
            <div class="lg:flex -mx-3">
                <div class="lg:w-3/4 px-3 mb-6">

                    <div class="mb-8">
                        <h2 class="text-lg text-grey font-normal mb-3">Tasks</h2>
                        {{-- tasks --}}
                        @foreach ($project->tasks as $task)
                            <div class="card mb-3">

                                <form action="{{ $task->path() }}" method="POST">
                                    @method('PATCH')
                                    
                                    @csrf
        
                                    <div class="flex items-center">
                                        <input name="body" value="{{ $task->body }}" class="w-full {{ $task->completed ? 'text-grey line-through' : '' }}">
                                        <input name="completed" type="checkbox" onchange="this.form.submit()" {{ $task->completed ? 'checked' : '' }}>
                                    </div>
                                </form>

                            </div>
                        @endforeach

                        <div class="card mb-3">
                            <form action="{{ $project->path() . '/tasks' }}" method="POST">
                                @csrf


                                <input placeholder="Add a New Task" class="w-full" name="body">
                            </form>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-lg text-grey font-normal mg-3">General Notes</h2>

                        {{-- genral notes --}}

                        <form action="{{ $project->path() }}" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            <textarea   name="notes"
                                        class="card w-full mb-4"
                                        style="min-height:200px"
                                        placeholder="Anything special that you want to make a note of?">
                                        {{ $project->notes }}
                            </textarea>

                            <button type="submit" class="button">Save</button>
                    
                            @include ('errors')
                        </form>
                    </div>

                </div>

                <div class="lg:w-1/4 px-3 lg:py-8">
                    @include('projects.card')
                </div>
            </div>
        </main>
    @endsection