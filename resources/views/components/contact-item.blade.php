<div class="flex items-start p-6 rounded-xl bg-white border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
    <div class="w-12 h-12 bg-decisioner-light-orange rounded-full flex items-center justify-center shrink-0 mr-4">
        {!! $icon !!}
    </div>
    <div>
        <h3 class="font-medium text-decisioner-charcoal mb-1">{{ $title }}</h3>
        @if ($link)
            <a href="{{ $link }}" class="text-decisioner-gray hover:text-decisioner-orange transition-colors">
                {{ $content }}
            </a>
        @else
            <p class="text-decisioner-gray">{{ $content }}</p>
        @endif
    </div>
</div>