@extends('frontend.layouts.default')

@section('content')

<div class="blog-posts-list">
    <ul>
        <?php if ($articles->count() > 0){ foreach($articles as $article){ ?>
        <li>
            <a href="{{ route('article', $article->slug) }}" title="Click to view article about <?php echo $article->title; ?>">
                <h2><?php echo $article->title; ?></h2>
            </a>
            <p>
                <?php echo $article->excerpt; ?>
            </p>
            <p class="meta"><?php echo $article->published_at; ?> &ndash; Programming</p>
        </li>
        <?php }}else{ ?>
        <li>
            No posts in database.
        </li>
        <?php } ?>
    </ul>
</div>

@stop
