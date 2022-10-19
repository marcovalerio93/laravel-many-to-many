@extends('layouts.app')

@section('content')

<div class="container">

    <form action="{{route('admin.posts.update', ['post'=> $post->id])}}" method="POST">

        @csrf
        @method('PUT')


        <div class="form-group">
            <label for="title">Category</label>
            <select name="category_id" class="form-control @error('title') is-invalid @enderror" id="category_id">
                    <option {{ (old('category_id', $post->category_id)=="")?'selected': ''}} value="">nessuna categoria</option>
                @foreach ($categories as $category)

                    <option {{ (old('category_id')==$category->id)?'selected': ''}}  value="{{ $category->id }}">{{ $category->name }}</option>
                    
                @endforeach
            </select>
            @error('category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                
            @enderror
            
        </div>

        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" required id="title" name='title'  max="255" value="{{ old('title', $post->title)}}" >
            <small class="form-text text-muted">Title</small>
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                
            @enderror
        </div>

        <div class="form-group">
            <label for="content">content</label>
            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name='content' required>{{ old('content', $post->content)}}</textarea>
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                
            @enderror 
        </div>

        <h3>Tag:</h3>

        <div class="card p-3">
            @foreach ($tags as $tag)
                <div class="form-group form-check">

                    @if ($errors->any())
                        <input {{ (in_array($tag->id,old('tags',[])))?'checked':''}} 
                            name="tags[]" 
                            type="checkbox" 
                            class="form-check-input" 
                            id="tag_{{ $tag->id }}" value="{{ $tag->id }}"
                        >
                    @else
                        <input {{ ($post->tags->contains($tag))?'checked':''}}
                            name="tags[]" 
                            type="checkbox" 
                            class="form-check-input" 
                            id="tag_{{ $tag->id }}" 
                            value="{{ $tag->id }}"
                            >     
                            
                    @endif
                    
                    <label class="form-check-label" for="{{ $tag->id }}">{{ $tag->name }}</label>      
                </div>
            @endforeach  
            @error('tags')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror 
        </div> 

        <button type="submit" class="btn btn-primary mb-5">Update </button>
    </form>

</div>


@endsection