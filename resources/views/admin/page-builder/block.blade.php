@php

    /*
    |--------------------------------------------------------------------------
    | BASIC BLOCK DATA
    |--------------------------------------------------------------------------
    */

    $namePrefix =
        $namePrefix
        ?? "content[{$section}][blocks][{$index}]";


    $imagePrefix =
        $imagePrefix
        ?? "images[{$section}][{$index}]";


    $type =
        $block['type']
        ?? 'text';


    $style =
        $block['style']
        ?? [];


    if (!is_array($style)) {
        $style = [];
    }


    /*
    |--------------------------------------------------------------------------
    | IMAGE VALUE NORMALIZER
    |--------------------------------------------------------------------------
    */

    $normalizeImageValue = function ($value) {

        if (is_array($value)) {

            foreach (
                [
                    'url',
                    'src',
                    'path',
                    'image',
                    'value'
                ]
                as $key
            ) {

                if (
                    isset($value[$key]) &&
                    is_scalar($value[$key])
                ) {

                    $value =
                        $value[$key];

                    break;
                }
            }
        }


        if (!is_scalar($value)) {
            return '';
        }


        return trim(
            (string) $value
        );
    };


    /*
    |--------------------------------------------------------------------------
    | IMAGE URL
    |--------------------------------------------------------------------------
    */

    $rawImageUrl =
        $normalizeImageValue(
            $block['url']
            ?? ''
        );


    $rawImagePath =
        $normalizeImageValue(
            $block['path']
            ?? ''
        );


    $imageUrl = '';


    if ($rawImageUrl !== '') {

        if (
            preg_match(
                '#^(https?:)?//#i',
                $rawImageUrl
            )
            ||
            str_starts_with(
                strtolower(
                    $rawImageUrl
                ),
                'data:image/'
            )
        ) {

            $imageUrl =
                $rawImageUrl;

        } elseif (
            str_starts_with(
                $rawImageUrl,
                '/storage/'
            )
        ) {

            $imageUrl =
                asset(
                    ltrim(
                        $rawImageUrl,
                        '/'
                    )
                );

        } elseif (
            str_starts_with(
                $rawImageUrl,
                'storage/'
            )
        ) {

            $imageUrl =
                asset(
                    $rawImageUrl
                );

        } elseif (
            str_starts_with(
                $rawImageUrl,
                'public/'
            )
        ) {

            $imageUrl =
                asset(
                    'storage/' .
                    ltrim(
                        substr(
                            $rawImageUrl,
                            7
                        ),
                        '/'
                    )
                );

        } else {

            $imageUrl =
                asset(
                    'storage/' .
                    ltrim(
                        $rawImageUrl,
                        '/'
                    )
                );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | IMAGE PATH
    |--------------------------------------------------------------------------
    */

    elseif ($rawImagePath !== '') {

        $cleanImagePath =
            ltrim(
                $rawImagePath,
                '/'
            );


        if (
            preg_match(
                '#^(https?:)?//#i',
                $cleanImagePath
            )
            ||
            str_starts_with(
                strtolower(
                    $cleanImagePath
                ),
                'data:image/'
            )
        ) {

            $imageUrl =
                $cleanImagePath;

        } elseif (
            str_starts_with(
                $cleanImagePath,
                'storage/'
            )
        ) {

            $imageUrl =
                asset(
                    $cleanImagePath
                );

        } elseif (
            str_starts_with(
                $cleanImagePath,
                'public/'
            )
        ) {

            $imageUrl =
                asset(
                    'storage/' .
                    ltrim(
                        substr(
                            $cleanImagePath,
                            7
                        ),
                        '/'
                    )
                );

        } else {

            $imageUrl =
                asset(
                    'storage/' .
                    $cleanImagePath
                );
        }
    }


    /*
    |--------------------------------------------------------------------------
    | STORED IMAGE VALUES
    |--------------------------------------------------------------------------
    */

    $imageStoredUrl =
        $rawImageUrl;


    $imageStoredPath =
        $rawImagePath;


    /*
    |--------------------------------------------------------------------------
    | ICONS
    |--------------------------------------------------------------------------
    */

    $selectedIcon =
        $block['icon']
        ?? 'bi-house';


    $icons = [

        'bi-house'
            => '🏠 House',

        'bi-person'
            => '👤 Person',

        'bi-heart'
            => '❤️ Heart',

        'bi-star'
            => '⭐ Star',

        'bi-gear'
            => '⚙️ Settings',

        'bi-search'
            => '🔍 Search',

        'bi-envelope'
            => '✉️ Email',

        'bi-phone'
            => '📱 Phone',

        'bi-camera'
            => '📷 Camera',

        'bi-image'
            => '🖼️ Image',

        'bi-cart'
            => '🛒 Cart',

        'bi-check-circle'
            => '✔️ Check',

        'bi-x-circle'
            => '❌ Close',

        'bi-arrow-right'
            => '➡️ Arrow Right',

        'bi-arrow-left'
            => '⬅️ Arrow Left',

        'bi-arrow-up'
            => '⬆️ Arrow Up',

        'bi-arrow-down'
            => '⬇️ Arrow Down',

        'bi-download'
            => 'Download',

        'bi-upload'
            => 'Upload',

        'bi-github'
            => 'GitHub',

        'bi-facebook'
            => 'Facebook',

        'bi-instagram'
            => 'Instagram',

        'bi-youtube'
            => 'YouTube',

        'bi-discord'
            => 'Discord',

        'bi-code-slash'
            => 'Code',

        'bi-terminal'
            => 'Terminal',

        'bi-laptop'
            => 'Laptop',

        'bi-database'
            => 'Database',

        'bi-cloud'
            => 'Cloud',

        'bi-lightning'
            => 'Lightning',

        'bi-lock'
            => 'Lock',

        'bi-unlock'
            => 'Unlock',

        'bi-bell'
            => 'Bell',

        'bi-calendar'
            => 'Calendar',

        'bi-chat'
            => 'Chat',

        'bi-share'
            => 'Share',

        'bi-link'
            => 'Link',

        'bi-book'
            => 'Book',

        'bi-folder'
            => 'Folder',

        'bi-file-earmark'
            => 'File',

        'bi-play-circle'
            => 'Play',

        'bi-pause-circle'
            => 'Pause',

        'bi-info-circle'
            => 'Info',

        'bi-question-circle'
            => 'Question',
    ];


    /*
    |--------------------------------------------------------------------------
    | STYLE VALUES
    |--------------------------------------------------------------------------
    */

    $textColor =
        $style['color']
        ?? '#0F3F4A';


    $backgroundColor =
        $style['background']
        ?? '#FFFFFF';


    $fontSize =
        $style['font_size']
        ?? '16px';


    $fontWeight =
        $style['font_weight']
        ?? '400';


    $textAlign =
        $style['text_align']
        ?? 'left';


    $width =
        $style['width']
        ?? 'auto';


    $height =
        $style['height']
        ?? 'auto';


    $padding =
        $style['padding']
        ?? '16px';


    $margin =
        $style['margin']
        ?? '0';


    $border =
        $style['border']
        ?? 'none';


    $radius =
        $style['radius']
        ?? '12px';


    $shadow =
        $style['shadow']
        ?? 'none';


    $transition =
        $style['transition']
        ?? 'transform 0.2s ease';


    /*
    |--------------------------------------------------------------------------
    | TRANSITION
    |--------------------------------------------------------------------------
    */

    $transitionDuration =
        '0.2s';


    if (
        preg_match(
            '/([0-9]*\.?[0-9]+)(ms|s)/',
            (string) $transition,
            $transitionMatch
        )
    ) {

        $transitionDuration =
            $transitionMatch[1] .
            $transitionMatch[2];
    }


    $transitionTiming =
        'ease';


    $timingOptions = [

        'ease',
        'linear',
        'ease-in',
        'ease-out',
        'ease-in-out',

    ];


    foreach (
        $timingOptions
        as $timingOption
    ) {

        if (
            str_contains(
                strtolower(
                    (string) $transition
                ),
                $timingOption
            )
        ) {

            $transitionTiming =
                $timingOption;

            break;
        }
    }

@endphp


<div
    class="builder-block"
    draggable="true"

    data-block-type="{{ $type }}"
    data-section="{{ $section }}"
    data-index="{{ $index }}"
    data-block-index="{{ $index }}"

    data-name-prefix="{{ $namePrefix }}"

    @if($type === 'group')
        data-is-group="true"
    @else
        data-is-group="false"
    @endif

    style="
        --block-color: {{ $textColor }};
        --block-background: {{ $backgroundColor }};
        --block-font-size: {{ $fontSize }};
        --block-font-weight: {{ $fontWeight }};
        --block-text-align: {{ $textAlign }};
        --block-width: {{ $width }};
        --block-height: {{ $height }};
        --block-padding: {{ $padding }};
        --block-margin: {{ $margin }};
        --block-border: {{ $border }};
        --block-radius: {{ $radius }};
        --block-shadow: {{ $shadow }};
        --block-transition: {{ $transition }};
    "
>


    <div
        class="block-content"

        style="
            color: var(--block-color);
            background-color: var(--block-background);

            width: 100%;
            max-width: 100%;
            min-width: 0;

            min-height: var(--block-height);

            padding: var(--block-padding);
            margin: var(--block-margin);

            border: var(--block-border);
            border-radius: var(--block-radius);

            box-shadow: var(--block-shadow);

            transition: var(--block-transition);

            box-sizing: border-box;

            overflow: hidden;
        "
    >


        {{-- =====================================================
             BLOCK HEADER
        ====================================================== --}}

        <div class="flex justify-between items-center">

            <strong class="text-[#0F3F4A]">

                @if($type === 'text')

                    <i class="bi bi-fonts mr-1"></i>
                    Text Block

                @elseif($type === 'heading')

                    <i class="bi bi-type-h1 mr-1"></i>
                    Heading Block

                @elseif($type === 'image')

                    <i class="bi bi-image mr-1"></i>
                    Image Block

                @elseif($type === 'button')

                    <i class="bi bi-hand-index-thumb mr-1"></i>
                    Button Block

                @elseif($type === 'divider')

                    <i class="bi bi-dash-lg mr-1"></i>
                    Divider

                @elseif($type === 'icon')

                    <i class="bi bi-stars mr-1"></i>
                    Icon Block

                @elseif($type === 'group')

                    <i class="bi bi-collection mr-1"></i>
                    Group / Container

                @endif

            </strong>


            <button
                type="button"
                onclick="removeBlock(this)"
                class="text-red-500 text-sm hover:underline"
            >
                Remove
            </button>

        </div>


        {{-- =====================================================
             GROUP
        ====================================================== --}}

        @if($type === 'group')

            @php

                $children =
                    $block['children']
                    ?? [];

                if (!is_array($children)) {
                    $children = [];
                }

            @endphp


            <div
                class="group-block-content"

                data-group-container="true"
                data-group-section="{{ $section }}"
            >


                <div class="flex justify-between items-center">

                    <strong class="text-[#0F3F4A]">

                        <i class="bi bi-collection mr-1"></i>

                        Group / Container

                    </strong>


                    <button
                        type="button"
                        onclick="removeBlock(this)"
                        class="text-red-500 text-sm hover:underline"
                    >
                        Remove
                    </button>

                </div>


                <p class="text-xs text-gray-500 mt-2 mb-3">

                    This is a separate group.
                    Drag blocks into this container or use the
                    grouping controls to place selected blocks here.

                </p>


                <div
                    class="group-drop-zone drop-zone"

                    data-group-zone="true"
                    data-group-container="true"
                    data-section="{{ $section }}"
                    data-parent-index="{{ $index }}"
                >

                    @foreach(
                        $children
                        as $childIndex => $childBlock
                    )

                        @if(is_array($childBlock))

                            @include(
                                'admin.page-builder.block',
                                [
                                    'block' =>
                                        $childBlock,

                                    'section' =>
                                        $section,

                                    'index' =>
                                        $childIndex,

                                    'namePrefix' =>
                                        $namePrefix .
                                        '[children][' .
                                        $childIndex .
                                        ']',

                                    'imagePrefix' =>
                                        $imagePrefix .
                                        '[children][' .
                                        $childIndex .
                                        ']'
                                ]
                            )

                        @endif

                    @endforeach


                    @if(empty($children))

                        <div
                            class="empty-zone"
                            data-empty-group-zone="true"
                        >
                            Drop components into this group
                        </div>

                    @endif

                </div>


                <input
                    type="hidden"

                    name="{{ $namePrefix }}[type]"

                    value="group"
                >


                <input
                    type="hidden"

                    name="{{ $namePrefix }}[children_present]"

                    value="1"
                >

            </div>

        @endif


        {{-- =====================================================
             TEXT
        ====================================================== --}}

        @if($type === 'text')

            <textarea
                name="{{ $namePrefix }}[text]"

                class="
                    mt-3
                    w-full
                    px-4
                    py-3
                    border
                    border-[#D5DDD8]
                    rounded-xl
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#4F806D]
                    live-style-target
                "

                rows="5"

                placeholder="Write your text..."

                style="
                    color: var(--block-color);
                    background-color: var(--block-background);
                    font-size: var(--block-font-size);
                    font-weight: var(--block-font-weight);
                    text-align: var(--block-text-align);

                    width: var(--block-width);
                    max-width: 100%;

                    min-height: var(--block-height);

                    padding: var(--block-padding);
                    margin: var(--block-margin);

                    border: var(--block-border);
                    border-radius: var(--block-radius);

                    box-shadow: var(--block-shadow);

                    transition: var(--block-transition);

                    box-sizing: border-box;
                "
            >{{ $block['text'] ?? '' }}</textarea>


            <input
                type="hidden"

                name="{{ $namePrefix }}[type]"

                value="text"
            >

        @endif


        {{-- =====================================================
             HEADING
        ====================================================== --}}

        @if($type === 'heading')

            <input
                type="text"

                name="{{ $namePrefix }}[text]"

                value="{{ $block['text'] ?? '' }}"

                class="
                    mt-3
                    w-full
                    px-4
                    py-3
                    border
                    border-[#D5DDD8]
                    rounded-xl
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#4F806D]
                    live-style-target
                "

                placeholder="Heading..."

                style="
                    color: var(--block-color);
                    background-color: var(--block-background);

                    font-size: var(--block-font-size);
                    font-weight: var(--block-font-weight);
                    text-align: var(--block-text-align);

                    width: var(--block-width);
                    max-width: 100%;

                    height: var(--block-height);

                    padding: var(--block-padding);
                    margin: var(--block-margin);

                    border: var(--block-border);
                    border-radius: var(--block-radius);

                    box-shadow: var(--block-shadow);

                    transition: var(--block-transition);

                    box-sizing: border-box;
                "
            >


            <input
                type="hidden"

                name="{{ $namePrefix }}[type]"

                value="heading"
            >

        @endif


        {{-- =====================================================
             IMAGE
        ====================================================== --}}

        @if($type === 'image')


            @if($imageUrl !== '')

                <div
                    class="
                        mt-4
                        image-preview-wrapper
                    "
                >

                    <p class="text-xs text-gray-500 mb-2">
                        Current Image
                    </p>


                    <div
                        class="image-preview-frame"
                    >

                        <img
                            src="{{ $imageUrl }}"

                            alt="{{ $block['alt'] ?? 'Page image' }}"

                            class="
                                image-preview
                                live-style-target
                            "

                            style="
                                color: var(--block-color);
                                background-color: var(--block-background);

                                width: var(--block-width);
                                height: var(--block-height);

                                max-width: 100%;
                                max-height: 100%;

                                padding: var(--block-padding);
                                margin: var(--block-margin);

                                border: var(--block-border);
                                border-radius: var(--block-radius);

                                box-shadow: var(--block-shadow);

                                transition: var(--block-transition);

                                box-sizing: border-box;

                                object-fit: contain;

                                display: block;
                            "
                        >

                    </div>

                </div>

            @endif


            <label
                class="
                    mt-4
                    block
                    text-sm
                    font-medium
                    text-[#0F3F4A]
                "
            >
                Upload New Image
            </label>


            <input
                type="file"

                name="{{ $imagePrefix }}"

                accept="image/jpeg,image/png,image/webp"

                class="
                    mt-2
                    w-full
                    text-sm
                "
            >


            <p class="text-xs text-gray-500 mt-2">
                JPG, PNG or WEBP. Maximum 5MB.
            </p>


            @if($imageStoredUrl !== '')

                <input
                    type="hidden"

                    name="{{ $namePrefix }}[url]"

                    value="{{ $imageStoredUrl }}"
                >

            @endif


            @if($imageStoredPath !== '')

                <input
                    type="hidden"

                    name="{{ $namePrefix }}[path]"

                    value="{{ $imageStoredPath }}"
                >

            @endif


            @if(!empty($block['alt']))

                <input
                    type="hidden"

                    name="{{ $namePrefix }}[alt]"

                    value="{{ $block['alt'] }}"
                >

            @endif


            <input
                type="hidden"

                name="{{ $namePrefix }}[type]"

                value="image"
            >

        @endif


        {{-- =====================================================
             BUTTON
        ====================================================== --}}

        @if($type === 'button')

            <input
                type="text"

                name="{{ $namePrefix }}[text]"

                value="{{ $block['text'] ?? '' }}"

                class="
                    mt-3
                    w-full
                    px-4
                    py-3
                    border
                    border-[#D5DDD8]
                    rounded-xl
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#4F806D]
                    live-style-target
                "

                placeholder="Button text"

                style="
                    color: var(--block-color);
                    background-color: var(--block-background);

                    font-size: var(--block-font-size);
                    font-weight: var(--block-font-weight);
                    text-align: var(--block-text-align);

                    width: var(--block-width);
                    max-width: 100%;

                    height: var(--block-height);

                    padding: var(--block-padding);
                    margin: var(--block-margin);

                    border: var(--block-border);
                    border-radius: var(--block-radius);

                    box-shadow: var(--block-shadow);

                    transition: var(--block-transition);

                    box-sizing: border-box;
                "
            >


            <input
                type="text"

                name="{{ $namePrefix }}[url]"

                value="{{ $block['url'] ?? '' }}"

                class="
                    mt-3
                    w-full
                    px-4
                    py-3
                    border
                    border-[#D5DDD8]
                    rounded-xl
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#4F806D]
                "

                placeholder="Button URL"
            >


            <input
                type="hidden"

                name="{{ $namePrefix }}[type]"

                value="button"
            >

        @endif


        {{-- =====================================================
             DIVIDER
        ====================================================== --}}

        @if($type === 'divider')

            <hr
                class="
                    my-4
                    live-style-target
                "

                style="
                    color: var(--block-color);
                    background-color: var(--block-background);

                    width: var(--block-width);
                    max-width: 100%;

                    height: var(--block-height);

                    padding: var(--block-padding);
                    margin: var(--block-margin);

                    border: var(--block-border);
                    border-radius: var(--block-radius);

                    box-shadow: var(--block-shadow);

                    transition: var(--block-transition);

                    box-sizing: border-box;
                "
            >


            <input
                type="hidden"

                name="{{ $namePrefix }}[type]"

                value="divider"
            >

        @endif


        {{-- =====================================================
             ICON
        ====================================================== --}}

        @if($type === 'icon')

            <div class="style-field">

                <label>
                    Choose Icon
                </label>


                <select
                    name="{{ $namePrefix }}[icon]"

                    class="icon-select"

                    onchange="updateIconPreview(this)"

                    data-icon-preview
                >

                    @foreach(
                        $icons
                        as $icon => $label
                    )

                        <option
                            value="{{ $icon }}"

                            @selected(
                                $selectedIcon === $icon
                            )
                        >
                            {{ $label }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div
                class="
                    icon-preview
                    live-style-target
                "

                style="
                    color: var(--block-color);
                    background-color: var(--block-background);

                    font-size: var(--block-font-size);
                    font-weight: var(--block-font-weight);
                    text-align: var(--block-text-align);

                    width: var(--block-width);
                    max-width: 100%;

                    height: var(--block-height);

                    padding: var(--block-padding);
                    margin: var(--block-margin);

                    border: var(--block-border);
                    border-radius: var(--block-radius);

                    box-shadow: var(--block-shadow);

                    transition: var(--block-transition);

                    box-sizing: border-box;
                "
            >

                <i class="bi {{ $selectedIcon }}"></i>

            </div>


            <input
                type="hidden"

                name="{{ $namePrefix }}[type]"

                value="icon"
            >

        @endif


    </div>


    {{-- =====================================================
         STYLE EDITOR
    ====================================================== --}}

    <div class="style-panel">


        <div class="style-title">

            <i class="bi bi-palette"></i>

            <span>
                Style Editor
            </span>

        </div>


        {{-- =================================================
             COLORS
        ================================================== --}}

        <div class="style-section-title">
            Colors
        </div>


        <div class="style-field">

            <label>
                Text Color
            </label>


            <div class="color-row">

                <input
                    type="color"

                    value="{{ $textColor }}"

                    data-style="color"

                    oninput="applyLiveStyle(this)"
                >


                <input
                    type="text"

                    name="{{ $namePrefix }}[style][color]"

                    value="{{ $textColor }}"

                    data-style="color"

                    oninput="applyLiveStyle(this)"
                >

            </div>

        </div>


        <div class="style-field">

            <label>
                Background Color
            </label>


            <div class="color-row">

                <input
                    type="color"

                    value="{{ $backgroundColor }}"

                    data-style="background"

                    oninput="applyLiveStyle(this)"
                >


                <input
                    type="text"

                    name="{{ $namePrefix }}[style][background]"

                    value="{{ $backgroundColor }}"

                    data-style="background"

                    oninput="applyLiveStyle(this)"
                >

            </div>

        </div>


        {{-- =================================================
             TYPOGRAPHY
        ================================================== --}}

        <div class="style-section-title">
            Typography
        </div>


        <div class="four-grid">

            <div>

                <label>
                    Font Size
                </label>


                <input
                    type="text"

                    name="{{ $namePrefix }}[style][font_size]"

                    value="{{ $fontSize }}"

                    data-style="font_size"

                    oninput="applyLiveStyle(this)"

                    placeholder="16px"
                >

            </div>


            <div>

                <label>
                    Font Weight
                </label>


                <select
                    name="{{ $namePrefix }}[style][font_weight]"

                    data-style="font_weight"

                    onchange="applyLiveStyle(this)"
                >

                    @foreach([
                        '400' => 'Normal',
                        '500' => 'Medium',
                        '600' => 'Semi Bold',
                        '700' => 'Bold',
                        '800' => 'Extra Bold'
                    ] as $weight => $label)

                        <option
                            value="{{ $weight }}"

                            @selected(
                                $fontWeight === $weight
                            )
                        >
                            {{ $label }}
                        </option>

                    @endforeach

                </select>

            </div>

        </div>


        <div class="style-field">

            <label>
                Text Alignment
            </label>


            <select
                name="{{ $namePrefix }}[style][text_align]"

                data-style="text_align"

                onchange="applyLiveStyle(this)"
            >

                <option
                    value="left"

                    @selected(
                        $textAlign === 'left'
                    )
                >
                    Left
                </option>


                <option
                    value="center"

                    @selected(
                        $textAlign === 'center'
                    )
                >
                    Center
                </option>


                <option
                    value="right"

                    @selected(
                        $textAlign === 'right'
                    )
                >
                    Right
                </option>

            </select>

        </div>


        {{-- =================================================
             SIZE
        ================================================== --}}

        <div class="style-section-title">
            Size
        </div>


        <div class="four-grid">

            <div>

                <label>
                    Width
                </label>


                <input
                    type="text"

                    name="{{ $namePrefix }}[style][width]"

                    value="{{ $width }}"

                    data-style="width"

                    oninput="applyLiveStyle(this)"

                    placeholder="100%, auto"
                >

            </div>


            <div>

                <label>
                    Height
                </label>


                <input
                    type="text"

                    name="{{ $namePrefix }}[style][height]"

                    value="{{ $height }}"

                    data-style="height"

                    oninput="applyLiveStyle(this)"

                    placeholder="auto, 300px"
                >

            </div>

        </div>


        {{-- =================================================
             SPACING
        ================================================== --}}

        <div class="style-section-title">
            Spacing
        </div>


        <div class="four-grid">

            <div>

                <label>
                    Padding
                </label>


                <input
                    type="text"

                    name="{{ $namePrefix }}[style][padding]"

                    value="{{ $padding }}"

                    data-style="padding"

                    oninput="applyLiveStyle(this)"

                    placeholder="16px"
                >

            </div>


            <div>

                <label>
                    Margin
                </label>


                <input
                    type="text"

                    name="{{ $namePrefix }}[style][margin]"

                    value="{{ $margin }}"

                    data-style="margin"

                    oninput="applyLiveStyle(this)"

                    placeholder="0"
                >

            </div>

        </div>


        {{-- =================================================
             BORDER
        ================================================== --}}

        <div class="style-section-title">
            Border
        </div>


        <div class="four-grid">

            <div>

                <label>
                    Border
                </label>


                <input
                    type="text"

                    name="{{ $namePrefix }}[style][border]"

                    value="{{ $border }}"

                    data-style="border"

                    oninput="applyLiveStyle(this)"

                    placeholder="1px solid #000"
                >

            </div>


            <div>

                <label>
                    Border Radius
                </label>


                <input
                    type="text"

                    name="{{ $namePrefix }}[style][radius]"

                    value="{{ $radius }}"

                    data-style="radius"

                    oninput="applyLiveStyle(this)"

                    placeholder="12px"
                >

            </div>

        </div>


        {{-- =================================================
             EFFECTS
        ================================================== --}}

        <div class="style-section-title">
            Effects
        </div>


        <div class="style-field">

            <label>
                Box Shadow
            </label>


            <input
                type="text"

                name="{{ $namePrefix }}[style][shadow]"

                value="{{ $shadow }}"

                data-style="shadow"

                oninput="applyLiveStyle(this)"

                placeholder="0 4px 12px rgba(0,0,0,.1)"
            >

        </div>


        <div class="style-field">

            <label>
                Transition Duration
            </label>


            <select
                class="transition-duration-select"

                data-transition-duration

                onchange="updateTransitionSettings(this)"
            >

                <option
                    value="0s"

                    @selected(
                        $transitionDuration === '0s'
                    )
                >
                    None
                </option>


                <option
                    value="0.1s"

                    @selected(
                        $transitionDuration === '0.1s'
                    )
                >
                    0.1s
                </option>


                <option
                    value="0.2s"

                    @selected(
                        $transitionDuration === '0.2s'
                    )
                >
                    0.2s
                </option>


                <option
                    value="0.3s"

                    @selected(
                        $transitionDuration === '0.3s'
                    )
                >
                    0.3s
                </option>


                <option
                    value="0.5s"

                    @selected(
                        $transitionDuration === '0.5s'
                    )
                >
                    0.5s
                </option>


                <option
                    value="0.75s"

                    @selected(
                        $transitionDuration === '0.75s'
                    )
                >
                    0.75s
                </option>


                <option
                    value="1s"

                    @selected(
                        $transitionDuration === '1s'
                    )
                >
                    1s
                </option>


                <option
                    value="1.5s"

                    @selected(
                        $transitionDuration === '1.5s'
                    )
                >
                    1.5s
                </option>


                <option
                    value="2s"

                    @selected(
                        $transitionDuration === '2s'
                    )
                >
                    2s
                </option>

            </select>

        </div>


        <div class="style-field">

            <label>
                Transition Easing
            </label>


            <select
                class="transition-timing-select"

                data-transition-timing

                onchange="updateTransitionSettings(this)"
            >

                <option
                    value="ease"

                    @selected(
                        $transitionTiming === 'ease'
                    )
                >
                    Ease
                </option>


                <option
                    value="linear"

                    @selected(
                        $transitionTiming === 'linear'
                    )
                >
                    Linear
                </option>


                <option
                    value="ease-in"

                    @selected(
                        $transitionTiming === 'ease-in'
                    )
                >
                    Ease In
                </option>


                <option
                    value="ease-out"

                    @selected(
                        $transitionTiming === 'ease-out'
                    )
                >
                    Ease Out
                </option>


                <option
                    value="ease-in-out"

                    @selected(
                        $transitionTiming === 'ease-in-out'
                    )
                >
                    Ease In Out
                </option>

            </select>

        </div>


        <input
            type="hidden"

            name="{{ $namePrefix }}[style][transition]"

            value="{{ $transition }}"

            data-style="transition"

            data-transition-value
        >

    </div>

</div>


<style>

    /*
    |--------------------------------------------------------------------------
    | GROUP
    |--------------------------------------------------------------------------
    */

    .group-block-content {
        margin-top: 14px;
        padding: 14px;

        border: 2px dashed #BFD8CE;
        border-radius: 12px;

        background: #F7FAF8;

        box-sizing: border-box;
        max-width: 100%;
        overflow: hidden;
    }


    .group-drop-zone {
        width: 100%;
        max-width: 100%;
        min-height: 100px;

        margin-top: 12px;
        padding: 12px;

        border: 1px dashed #C8D8D1;
        border-radius: 10px;

        background: #FFFFFF;

        box-sizing: border-box;

        overflow: hidden;

        transition:
            background-color 0.15s ease,
            border-color 0.15s ease,
            outline 0.15s ease;
    }


    .group-drop-zone.drag-over {
        background: #E5EEF0;
        border-color: #4F806D;

        outline: 2px dashed #4F806D;
        outline-offset: -5px;
    }


    .group-drop-zone .empty-zone {
        padding: 20px;

        text-align: center;

        color: #6B7280;

        pointer-events: none;
    }


    .group-drop-zone > .builder-block {
        width: 100%;
        max-width: 100%;

        margin-bottom: 12px;

        box-sizing: border-box;
    }


    .group-drop-zone > .builder-block:last-child {
        margin-bottom: 0;
    }


    .group-drop-zone .group-drop-zone {
        min-height: 80px;
        background: #FAFCFB;
    }


    /*
    |--------------------------------------------------------------------------
    | IMAGE PREVIEW
    |--------------------------------------------------------------------------
    */

    .image-preview-wrapper {
        width: 100%;
        max-width: 100%;
        min-width: 0;

        box-sizing: border-box;

        overflow: hidden;
    }


    .image-preview-frame {
        width: 100%;
        max-width: 100%;
        min-width: 0;

        box-sizing: border-box;

        overflow: hidden;

        display: block;
    }


    .image-preview {
        display: block;

        max-width: 100%;
        max-height: 100%;

        box-sizing: border-box;

        object-fit: contain;

        vertical-align: middle;
    }


    /*
    |--------------------------------------------------------------------------
    | SELECTED GROUP
    |--------------------------------------------------------------------------
    */

    .builder-block.group-selected {
        position: relative;

        outline: 2px solid #4F806D;
        outline-offset: 3px;
    }


    .builder-block.group-selected::after {
        content: 'Selected';

        position: absolute;

        top: 6px;
        right: 8px;

        z-index: 20;

        padding: 2px 7px;

        border-radius: 999px;

        background: #4F806D;
        color: #FFFFFF;

        font-size: 10px;
        line-height: 1.4;

        pointer-events: none;
    }


    .builder-block[data-is-group="true"] {
        position: relative;
    }


    .builder-block.dragging {
        opacity: 0.55;
    }


    .builder-block.group-drop-target {
        outline: 2px solid #4F806D;
        outline-offset: 4px;
    }

</style>


<script>

    /*
    |--------------------------------------------------------------------------
    | TRANSITION
    |--------------------------------------------------------------------------
    */

    function updateTransitionSettings(element) {

        const block =
            element.closest(
                '.builder-block'
            );


        if (!block) {
            return;
        }


        const durationSelect =
            block.querySelector(
                '[data-transition-duration]'
            );


        const timingSelect =
            block.querySelector(
                '[data-transition-timing]'
            );


        const transitionInput =
            block.querySelector(
                '[data-transition-value]'
            );


        if (
            !durationSelect ||
            !timingSelect ||
            !transitionInput
        ) {

            return;
        }


        const duration =
            durationSelect.value;


        const timing =
            timingSelect.value;


        let transitionValue;


        if (
            duration === '0s'
        ) {

            transitionValue =
                'none';

        } else {

            transitionValue =
                'transform ' +
                duration +
                ' ' +
                timing;
        }


        transitionInput.value =
            transitionValue;


        block.style.setProperty(
            '--block-transition',
            transitionValue
        );


        const targets =
            block.querySelectorAll(
                '.live-style-target'
            );


        targets.forEach(
            function(target) {

                target.style.transition =
                    transitionValue;

            }
        );
    }


    /*
    |--------------------------------------------------------------------------
    | ICON PREVIEW
    |--------------------------------------------------------------------------
    */

    function updateIconPreview(select) {

        const block =
            select.closest(
                '.builder-block'
            );


        if (!block) {
            return;
        }


        const preview =
            block.querySelector(
                '.icon-preview'
            );


        if (!preview) {
            return;
        }


        const icon =
            preview.querySelector(
                'i'
            );


        if (!icon) {
            return;
        }


        icon.className =
            'bi ' +
            select.value;
    }


    /*
    |--------------------------------------------------------------------------
    | GROUP EMPTY STATE
    |--------------------------------------------------------------------------
    */

    function refreshGroupEmptyState(
        groupZone
    ) {

        if (!groupZone) {
            return;
        }


        const children =
            groupZone.querySelectorAll(
                ':scope > .builder-block'
            );


        const emptyMessage =
            groupZone.querySelector(
                ':scope > .empty-zone'
            );


        if (
            children.length > 0
        ) {

            if (emptyMessage) {
                emptyMessage.remove();
            }

        } else {

            if (!emptyMessage) {

                const empty =
                    document.createElement(
                        'div'
                    );


                empty.className =
                    'empty-zone';


                empty.dataset.emptyGroupZone =
                    'true';


                empty.textContent =
                    'Drop components into this group';


                groupZone.appendChild(
                    empty
                );
            }
        }
    }


    /*
    |--------------------------------------------------------------------------
    | GROUP DROP ZONE
    |--------------------------------------------------------------------------
    */

    function getGroupDropZone(
        groupBlock
    ) {

        if (!groupBlock) {
            return null;
        }


        return groupBlock.querySelector(
            ':scope > .block-content ' +
            '.group-block-content > ' +
            '.group-drop-zone'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | PARENT GROUP
    |--------------------------------------------------------------------------
    */

    function getParentGroup(
        block
    ) {

        if (!block) {
            return null;
        }


        const zone =
            block.closest(
                '[data-group-zone="true"]'
            );


        if (!zone) {
            return null;
        }


        return zone.closest(
            '.builder-block[data-is-group="true"]'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | REFRESH GROUP
    |--------------------------------------------------------------------------
    */

    function refreshGroupAfterMove(
        groupBlock
    ) {

        if (!groupBlock) {
            return;
        }


        const zone =
            getGroupDropZone(
                groupBlock
            );


        if (!zone) {
            return;
        }


        refreshGroupEmptyState(
            zone
        );
    }


    /*
    |--------------------------------------------------------------------------
    | GLOBALS
    |--------------------------------------------------------------------------
    */

    window.getGroupDropZone =
        getGroupDropZone;


    window.getParentGroup =
        getParentGroup;


    window.refreshGroupEmptyState =
        refreshGroupEmptyState;


    window.refreshGroupAfterMove =
        refreshGroupAfterMove;

</script>