@php
    /*
    |--------------------------------------------------------------------------
    | PAGE BUILDER BLOCK RENDERER
    |--------------------------------------------------------------------------
    |
    | This partial recursively renders page-builder blocks.
    |
    | Groups are treated as ONE container.
    | Their children are rendered INSIDE that container.
    |
    */

    $blocks = $blocks ?? [];

    if (!is_array($blocks)) {
        $blocks = [];
    }

    $insideGroup = $insideGroup ?? false;
@endphp


@foreach($blocks as $block)

    @if(!is_array($block))
        @continue
    @endif

    @php
        $type = $block['type'] ?? null;

        if (!$type) {
            continue;
        }

        $style = $block['style'] ?? [];

        if (!is_array($style)) {
            $style = [];
        }

        $styleString = '';

        $styleMap = [
            'color'       => 'color',
            'background'  => 'background-color',
            'font_size'   => 'font-size',
            'font_weight' => 'font-weight',
            'text_align'  => 'text-align',
            'width'       => 'width',
            'height'      => 'height',
            'padding'     => 'padding',
            'margin'      => 'margin',
            'border'      => 'border',
            'radius'      => 'border-radius',
            'shadow'      => 'box-shadow',
            'transition'  => 'transition',
        ];

        foreach ($styleMap as $key => $property) {
            if (isset($style[$key]) && $style[$key] !== '') {
                $styleString .=
                    $property . ':' .
                    e($style[$key]) .
                    ';';
            }
        }
    @endphp


    {{-- =========================================================
         GROUP
    ========================================================== --}}

    @if($type === 'group')

        @php
            $groupStyle = $styleString;

            if (empty($style['background'])) {
                $groupStyle .= 'background-color:#FFFFFF;';
            }

            if (empty($style['border'])) {
                $groupStyle .= 'border:1px solid #D5DDD8;';
            }

            if (empty($style['radius'])) {
                $groupStyle .= 'border-radius:16px;';
            }

            if (empty($style['padding'])) {
                $groupStyle .= 'padding:24px;';
            }

            if (empty($style['shadow'])) {
                $groupStyle .=
                    'box-shadow:0 4px 14px rgba(0,0,0,.05);';
            }
        @endphp


        <div
            class="page-builder-group"
            style="{{ $groupStyle }}"
        >

            @if(!empty($block['label']))

                <div class="page-builder-group-label">
                    {{ $block['label'] }}
                </div>

            @endif


            @if(
                isset($block['children']) &&
                is_array($block['children']) &&
                count($block['children']) > 0
            )

                <div class="page-builder-group-children">

                    @include(
                        'pages.blocks',
                        [
                            'blocks' => $block['children'],
                            'insideGroup' => true
                        ]
                    )

                </div>

            @endif

        </div>


        @continue

    @endif


    {{-- =========================================================
         HEADING
    ========================================================== --}}

    @if($type === 'heading')

        @php
            $level = $block['level'] ?? 2;

            $headingTag = in_array(
                (int) $level,
                [1, 2, 3, 4, 5, 6],
                true
            )
                ? 'h' . (int) $level
                : 'h2';
        @endphp


        <{{ $headingTag }}
            class="page-builder-block page-builder-heading"
            style="{{ $styleString }}"
        >
            {{ $block['text'] ?? '' }}
        </{{ $headingTag }}>


        @continue

    @endif


    {{-- =========================================================
         TEXT
    ========================================================== --}}

    @if($type === 'text')

        <div
            class="page-builder-block page-builder-text"
            style="{{ $styleString }}"
        >
            {!! nl2br(e($block['text'] ?? '')) !!}
        </div>


        @continue

    @endif


    {{-- =========================================================
         IMAGE
    ========================================================== --}}

    @if($type === 'image')

        @php
            $imageUrl = $block['url'] ?? null;

            if (
                !$imageUrl &&
                !empty($block['path'])
            ) {
                $imageUrl = asset(
                    'storage/' .
                    ltrim($block['path'], '/')
                );
            }
        @endphp


        @if($imageUrl)

            <div
                class="page-builder-block page-builder-image"
                style="{{ $styleString }}"
            >

                <img
                    src="{{ $imageUrl }}"
                    alt="{{ $block['alt'] ?? 'Page image' }}"
                >

            </div>

        @endif


        @continue

    @endif


    {{-- =========================================================
         BUTTON
    ========================================================== --}}

    @if($type === 'button')

        <div
            class="page-builder-block page-builder-button-wrapper"
            style="{{ $styleString }}"
        >

            <a
                href="{{ $block['url'] ?? '#' }}"
                class="page-builder-button"
            >
                {{ $block['text'] ?? 'Button' }}
            </a>

        </div>


        @continue

    @endif


    {{-- =========================================================
         DIVIDER
    ========================================================== --}}

    @if($type === 'divider')

        <hr
            class="page-builder-block page-builder-divider"
            style="{{ $styleString }}"
        >


        @continue

    @endif


    {{-- =========================================================
         ICON
    ========================================================== --}}

    @if($type === 'icon')

        <div
            class="page-builder-block page-builder-icon"
            style="{{ $styleString }}"
        >

            <i
                class="bi {{ $block['icon'] ?? 'bi-house' }}"
            ></i>

        </div>


        @continue

    @endif


@endforeach


<style>

.page-builder-block {
    box-sizing: border-box;
}


/*
|--------------------------------------------------------------------------
| GROUP
|--------------------------------------------------------------------------
*/

.page-builder-group {
    width: 100%;
    box-sizing: border-box;
    overflow: hidden;
}


.page-builder-group-label {
    margin-bottom: 20px;
    font-size: 14px;
    font-weight: 600;
    color: #0F3F4A;
}


.page-builder-group-children {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 20px;
}


/*
|--------------------------------------------------------------------------
| HEADING
|--------------------------------------------------------------------------
*/

.page-builder-heading {
    color: #0F3F4A;
    font-weight: 700;
    margin: 0;
}


/*
|--------------------------------------------------------------------------
| TEXT
|--------------------------------------------------------------------------
*/

.page-builder-text {
    width: 100%;
    color: #333;
    line-height: 1.75;
    white-space: normal;
}


/*
|--------------------------------------------------------------------------
| IMAGE
|--------------------------------------------------------------------------
*/

.page-builder-image {
    width: 100%;
}


.page-builder-image img {
    display: block;
    max-width: 100%;
    height: auto;
    border-radius: 12px;
}


/*
|--------------------------------------------------------------------------
| BUTTON
|--------------------------------------------------------------------------
*/

.page-builder-button-wrapper {
    display: block;
}


.page-builder-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    padding: 12px 20px;

    border-radius: 12px;

    background: #4F806D;
    color: #FFFFFF;

    font-weight: 600;

    text-decoration: none;

    transition:
        transform 0.2s ease,
        background-color 0.2s ease;
}


.page-builder-button:hover {
    background: #3E735F;
    color: #FFFFFF;
    transform: translateY(-2px);
}


/*
|--------------------------------------------------------------------------
| DIVIDER
|--------------------------------------------------------------------------
*/

.page-builder-divider {
    width: 100%;
}


/*
|--------------------------------------------------------------------------
| ICON
|--------------------------------------------------------------------------
*/

.page-builder-icon {
    display: flex;
    align-items: center;
}


/*
|--------------------------------------------------------------------------
| MOBILE
|--------------------------------------------------------------------------
*/

@media (max-width: 640px) {

    .page-builder-group {
        padding: 18px !important;
    }

}

</style>