<article @php(post_class('h-entry'))>
    <h1 class="text-4xl mb-10" >
      {!! $title !!}
    </h1>
    @php(the_content())
</article>
