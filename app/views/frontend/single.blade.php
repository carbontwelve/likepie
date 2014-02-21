@extends('frontend.layouts.default')

@section('content')
<div>

    <a href="{{ route('article', $article->slug) }}" title="Click to view article about <?php echo $article->title; ?>">
        <h2><?php echo $article->title; ?></h2>
    </a>

    <?php echo $article->html; ?>

    <p class="meta"><?php echo $article->published_at; ?> &ndash; Programming</p>
</div>
@stop
