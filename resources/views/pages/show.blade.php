@extends('layouts.app')

@section('title', $page->title ?? 'DevNext')

@section('content')

@php

    /*
    |--------------------------------------------------------------------------
    | PAGE CONTENT
    |--------------------------------------------------------------------------
    */

    $content = $page->content ?? [];

    /*
     * Some older records may contain JSON as a string.
     */
    if (is_string($content)) {

        $decoded = json_decode(
            $content,
            true
        );

        if (
            json_last_error() === JSON_ERROR_NONE &&
            is_array($decoded)
        ) {
            $content = $decoded;
        }
    }

    if (!is_array($content)) {
        $content = [];
    }


    /*
    |--------------------------------------------------------------------------
    | NORMALIZE BLOCKS
    |--------------------------------------------------------------------------
    */

    $normalizeBlocks = function ($blocks) {

        if (
            $blocks instanceof
            \Illuminate\Support\Collection
        ) {
            $blocks = $blocks->toArray();
        }

        if (!is_array($blocks)) {
            return [];
        }

        /*
         * Support:
         *
         * [
         *     'blocks' => [...]
         * ]
         */
        if (
            isset($blocks['blocks']) &&
            is_array($blocks['blocks'])
        ) {
            $blocks = $blocks['blocks'];
        }

        $result = [];

        foreach ($blocks as $block) {

            if (
                $block instanceof
                \Illuminate\Support\Collection
            ) {
                $block = $block->toArray();
            }

            if (!is_array($block)) {
                continue;
            }

            if (empty($block)) {
                continue;
            }

            $result[] = $block;
        }

        return array_values($result);
    };


    /*
    |--------------------------------------------------------------------------
    | GET PAGE SECTIONS
    |--------------------------------------------------------------------------
    */

    $headerBlocks = $normalizeBlocks(
        data_get(
            $content,
            'header.blocks',
            []
        )
    );

    $bodyBlocks = $normalizeBlocks(
        data_get(
            $content,
            'body.blocks',
            []
        )
    );

    /*
     * Side content is intentionally separate from Body.
     */
    $sideBlocks = $normalizeBlocks(
        data_get(
            $content,
            'side_content.blocks',
            []
        )
    );

    /*
     * Compatibility with possible older naming.
     */
    if (empty($sideBlocks)) {

        $sideBlocks = $normalizeBlocks(
            data_get(
                $content,
                'sidebar.blocks',
                []
            )
        );
    }

    if (empty($sideBlocks)) {

        $sideBlocks = $normalizeBlocks(
            data_get(
                $content,
                'side.blocks',
                []
            )
        );
    }

    $footerBlocks = $normalizeBlocks(
        data_get(
            $content,
            'footer.blocks',
            []
        )
    );


    /*
    |--------------------------------------------------------------------------
    | SIDE CONTENT ENABLED
    |--------------------------------------------------------------------------
    */

    $layoutSide = data_get(
        $content,
        'layout.show_side_content',
        false
    );

    $layoutSide =
        $layoutSide === true ||
        $layoutSide === 1 ||
        $layoutSide === '1' ||
        $layoutSide === 'true' ||
        $layoutSide === 'on' ||
        $layoutSide === 'yes';

    /*
     * If side blocks actually exist, show the sidebar even if
     * the old layout flag was not saved.
     */
    $showSideContent =
        $layoutSide ||
        !empty($sideBlocks);


    /*
    |--------------------------------------------------------------------------
    | CSS VALUE SANITIZER
    |--------------------------------------------------------------------------
    */

    $safeCssValue = function ($value, $fallback = '') {

        if (
            $value === null ||
            $value === ''
        ) {
            return $fallback;
        }

        if (!is_scalar($value)) {
            return $fallback;
        }

        return trim((string) $value);
    };


    /*
    |--------------------------------------------------------------------------
    | BUILD STYLE
    |--------------------------------------------------------------------------
    */

    $buildStyle = function (
        $style,
        $includeDimensions = true
    ) use ($safeCssValue) {

        if (!is_array($style)) {
            return '';
        }

        $styleMap = [

            'color'
                => 'color',

            'background'
                => 'background-color',

            'background_color'
                => 'background-color',

            'font_size'
                => 'font-size',

            'font_weight'
                => 'font-weight',

            'text_align'
                => 'text-align',

            'width'
                => 'width',

            'height'
                => 'height',

            'padding'
                => 'padding',

            'margin'
                => 'margin',

            'border'
                => 'border',

            'radius'
                => 'border-radius',

            'border_radius'
                => 'border-radius',

            'shadow'
                => 'box-shadow',

            'transition'
                => 'transition',

            'line_height'
                => 'line-height',

            'letter_spacing'
                => 'letter-spacing',

            'display'
                => 'display',

            'gap'
                => 'gap',

            'max_width'
                => 'max-width',

            'min_width'
                => 'min-width',

            'max_height'
                => 'max-height',

            'min_height'
                => 'min-height',
        ];


        /*
         * For an image wrapper we do NOT put width/height
         * on the wrapper. Those dimensions belong to the image.
         */
        if (!$includeDimensions) {

            unset(
                $styleMap['width'],
                $styleMap['height']
            );
        }


        $styleString = '';

        foreach (
            $styleMap as $key => $property
        ) {

            if (
                array_key_exists(
                    $key,
                    $style
                )
            ) {

                $value =
                    $safeCssValue(
                        $style[$key]
                    );

                if ($value === '') {
                    continue;
                }

                $styleString .=
                    $property .
                    ':' .
                    e($value) .
                    ';';
            }
        }

        return $styleString;
    };


    /*
    |--------------------------------------------------------------------------
    | GET BLOCK TYPE
    |--------------------------------------------------------------------------
    */

    $getBlockType = function ($block) {

        if (!is_array($block)) {
            return null;
        }

        if (
            isset($block['type']) &&
            is_string($block['type'])
        ) {

            return strtolower(
                trim(
                    $block['type']
                )
            );
        }

        if (
            isset($block['component']) &&
            is_string($block['component'])
        ) {

            return strtolower(
                trim(
                    $block['component']
                )
            );
        }

        if (
            isset($block['block_type']) &&
            is_string($block['block_type'])
        ) {

            return strtolower(
                trim(
                    $block['block_type']
                )
            );
        }

        if (
            isset($block['kind']) &&
            is_string($block['kind'])
        ) {

            return strtolower(
                trim(
                    $block['kind']
                )
            );
        }

        return null;
    };


    /*
    |--------------------------------------------------------------------------
    | GROUP CHILDREN
    |--------------------------------------------------------------------------
    */

    $getGroupChildren = function ($block)
    use ($normalizeBlocks) {

        if (!is_array($block)) {
            return [];
        }

        if (
            isset($block['children']) &&
            is_array($block['children'])
        ) {

            return $normalizeBlocks(
                $block['children']
            );
        }

        if (
            isset($block['blocks']) &&
            is_array($block['blocks'])
        ) {

            return $normalizeBlocks(
                $block['blocks']
            );
        }

        if (
            isset($block['content']) &&
            is_array($block['content'])
        ) {

            if (
                isset(
                    $block['content']['children']
                ) &&
                is_array(
                    $block['content']['children']
                )
            ) {

                return $normalizeBlocks(
                    $block['content']['children']
                );
            }

            if (
                isset(
                    $block['content']['blocks']
                ) &&
                is_array(
                    $block['content']['blocks']
                )
            ) {

                return $normalizeBlocks(
                    $block['content']['blocks']
                );
            }
        }

        return [];
    };


    /*
    |--------------------------------------------------------------------------
    | IMAGE URL RESOLVER
    |--------------------------------------------------------------------------
    */

    $resolveImageUrl = function ($block) {

        if (!is_array($block)) {
            return null;
        }

        $imageUrl = null;


        /*
        |--------------------------------------------------------------------------
        | DIRECT URL
        |--------------------------------------------------------------------------
        */

        if (
            !empty($block['url']) &&
            is_string($block['url'])
        ) {

            $imageUrl =
                trim(
                    $block['url']
                );
        }


        /*
        |--------------------------------------------------------------------------
        | DIRECT SRC
        |--------------------------------------------------------------------------
        */

        if (
            !$imageUrl &&
            !empty($block['src']) &&
            is_string($block['src'])
        ) {

            $imageUrl =
                trim(
                    $block['src']
                );
        }


        /*
        |--------------------------------------------------------------------------
        | DIRECT PATH
        |--------------------------------------------------------------------------
        */

        if (
            !$imageUrl &&
            !empty($block['path']) &&
            is_string($block['path'])
        ) {

            $path =
                ltrim(
                    trim(
                        $block['path']
                    ),
                    '/'
                );

            if (
                str_starts_with(
                    $path,
                    'http://'
                ) ||
                str_starts_with(
                    $path,
                    'https://'
                ) ||
                str_starts_with(
                    $path,
                    '//'
                ) ||
                str_starts_with(
                    $path,
                    'data:'
                )
            ) {

                $imageUrl = $path;

            } elseif (
                str_starts_with(
                    $path,
                    'storage/'
                )
            ) {

                $imageUrl =
                    asset($path);

            } else {

                $imageUrl =
                    asset(
                        'storage/' .
                        $path
                    );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | IMAGE OBJECT / VALUE
        |--------------------------------------------------------------------------
        */

        if (
            !$imageUrl &&
            array_key_exists(
                'image',
                $block
            )
        ) {

            $image =
                $block['image'];


            if (
                is_string($image) &&
                trim($image) !== ''
            ) {

                $value =
                    trim($image);

                if (
                    str_starts_with(
                        $value,
                        'http://'
                    ) ||
                    str_starts_with(
                        $value,
                        'https://'
                    ) ||
                    str_starts_with(
                        $value,
                        '//'
                    ) ||
                    str_starts_with(
                        $value,
                        'data:'
                    )
                ) {

                    $imageUrl =
                        $value;

                } else {

                    $value =
                        ltrim(
                            $value,
                            '/'
                        );

                    if (
                        str_starts_with(
                            $value,
                            'storage/'
                        )
                    ) {

                        $imageUrl =
                            asset($value);

                    } else {

                        $imageUrl =
                            asset(
                                'storage/' .
                                $value
                            );
                    }
                }
            }


            if (
                !$imageUrl &&
                is_array($image)
            ) {

                foreach (
                    [
                        'url',
                        'src',
                        'path',
                        'value'
                    ]
                    as $imageKey
                ) {

                    if (
                        isset(
                            $image[$imageKey]
                        ) &&
                        is_scalar(
                            $image[$imageKey]
                        )
                    ) {

                        $value =
                            trim(
                                (string)
                                $image[$imageKey]
                            );

                        if ($value === '') {
                            continue;
                        }

                        if (
                            str_starts_with(
                                $value,
                                'http://'
                            ) ||
                            str_starts_with(
                                $value,
                                'https://'
                            ) ||
                            str_starts_with(
                                $value,
                                '//'
                            ) ||
                            str_starts_with(
                                $value,
                                'data:'
                            )
                        ) {

                            $imageUrl =
                                $value;

                        } else {

                            $value =
                                ltrim(
                                    $value,
                                    '/'
                                );

                            if (
                                str_starts_with(
                                    $value,
                                    'storage/'
                                )
                            ) {

                                $imageUrl =
                                    asset(
                                        $value
                                    );

                            } else {

                                $imageUrl =
                                    asset(
                                        'storage/' .
                                        $value
                                    );
                            }
                        }

                        break;
                    }
                }
            }
        }


        if (
            is_string($imageUrl) &&
            trim($imageUrl) !== ''
        ) {

            return $imageUrl;
        }

        return null;
    };


    /*
    |--------------------------------------------------------------------------
    | RENDER BLOCKS
    |--------------------------------------------------------------------------
    */

    $renderBlocks = function (
        $blocks,
        $insideGroup = false
    ) use (
        &$renderBlocks,
        $normalizeBlocks,
        $buildStyle,
        $getBlockType,
        $getGroupChildren,
        $resolveImageUrl
    ) {

        $blocks =
            $normalizeBlocks(
                $blocks
            );

        if (empty($blocks)) {
            return;
        }


        foreach ($blocks as $block) {

            if (!is_array($block)) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | TYPE
            |--------------------------------------------------------------------------
            */

            $type =
                $getBlockType(
                    $block
                );

            if (!$type) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | STYLE
            |--------------------------------------------------------------------------
            */

            $style =
                isset($block['style']) &&
                is_array($block['style'])
                    ? $block['style']
                    : [];

            $styleString =
                $buildStyle(
                    $style
                );


            /*
            |--------------------------------------------------------------------------
            | GROUP
            |--------------------------------------------------------------------------
            */

            if (
                $type === 'group' ||
                $type === 'container' ||
                $type === 'group/container'
            ) {

                $groupChildren =
                    $getGroupChildren(
                        $block
                    );


                $groupStyle =
                    $styleString;


                /*
                 * Defaults.
                 */

                if (
                    !isset(
                        $style['background']
                    ) &&
                    !isset(
                        $style['background_color']
                    )
                ) {

                    $groupStyle .=
                        'background-color:#FFFFFF;';
                }


                if (
                    !isset(
                        $style['border']
                    )
                ) {

                    $groupStyle .=
                        'border:1px solid #D5DDD8;';
                }


                if (
                    !isset(
                        $style['radius']
                    ) &&
                    !isset(
                        $style['border_radius']
                    )
                ) {

                    $groupStyle .=
                        'border-radius:16px;';
                }


                if (
                    !isset(
                        $style['padding']
                    )
                ) {

                    $groupStyle .=
                        'padding:24px;';
                }


                if (
                    !isset(
                        $style['shadow']
                    )
                ) {

                    $groupStyle .=
                        'box-shadow:0 4px 14px rgba(0,0,0,.05);';
                }


                echo '<div
                    class="page-builder-group"
                    style="' .
                    $groupStyle .
                    '"
                >';


                /*
                 * Only show a custom group label.
                 *
                 * "Group" is intentionally hidden.
                 */

                $groupLabel =
                    $block['label']
                    ?? $block['name']
                    ?? '';

                if (
                    $groupLabel !== '' &&
                    strtolower(
                        trim(
                            (string)
                            $groupLabel
                        )
                    ) !== 'group'
                ) {

                    echo '<div
                        class="page-builder-group-label"
                    >' .
                        e($groupLabel) .
                    '</div>';
                }


                echo '<div
                    class="page-builder-group-children"
                >';


                if (!empty($groupChildren)) {

                    $renderBlocks(
                        $groupChildren,
                        true
                    );
                }


                echo '</div>';

                echo '</div>';

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | TEXT
            |--------------------------------------------------------------------------
            */

            if ($type === 'text') {

                $text =
                    $block['text']
                    ?? $block['content']
                    ?? '';


                echo '<div
                    class="page-builder-block page-builder-text"
                    style="' .
                    $styleString .
                    '"
                >';

                echo '<p
                    class="page-builder-text-content"
                >' .
                    e($text) .
                '</p>';

                echo '</div>';

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | HEADING
            |--------------------------------------------------------------------------
            */

            if ($type === 'heading') {

                $heading =
                    $block['text']
                    ?? $block['content']
                    ?? $block['label']
                    ?? '';


                echo '<h2
                    class="page-builder-block page-builder-heading"
                    style="' .
                    $styleString .
                    '"
                >' .
                    e($heading) .
                '</h2>';

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | IMAGE
            |--------------------------------------------------------------------------
            */

            if ($type === 'image') {

                $imageUrl =
                    $resolveImageUrl(
                        $block
                    );


                if ($imageUrl) {

                    $imageAlt =
                        $block['alt']
                        ?? $block['title']
                        ?? 'Page image';


                    /*
                    |--------------------------------------------------------------------------
                    | IMPORTANT IMAGE FIX
                    |--------------------------------------------------------------------------
                    |
                    | Width and height are NOT placed on the wrapper.
                    |
                    | They are applied directly to the image.
                    |
                    */

                    $imageWrapperStyle =
                        $buildStyle(
                            $style,
                            false
                        );


                    $imageStyle =
                        $buildStyle(
                            $style,
                            true
                        );


                    /*
                     * Make sure dimensions cannot escape
                     * the available page column.
                     */

                    $imageStyle .=
                        'max-width:100%;';

                    $imageStyle .=
                        'box-sizing:border-box;';

                    $imageStyle .=
                        'object-fit:contain;';


                    echo '<div
                        class="page-builder-block page-builder-image-wrapper"
                        style="' .
                        $imageWrapperStyle .
                        '"
                    >';


                    echo '<img
                        src="' .
                        e($imageUrl) .
                        '"
                        alt="' .
                        e($imageAlt) .
                        '"
                        class="page-builder-image"
                        style="' .
                        $imageStyle .
                        '"
                    >';


                    echo '</div>';
                }

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | BUTTON
            |--------------------------------------------------------------------------
            */

            if ($type === 'button') {

                $buttonText =
                    $block['text']
                    ?? $block['label']
                    ?? $block['title']
                    ?? 'Button';


                $buttonUrl =
                    $block['url']
                    ?? $block['href']
                    ?? '#';


                $buttonStyle =
                    $styleString;


                if (
                    empty(
                        $style['transition']
                    )
                ) {

                    $buttonStyle .=
                        'transition:transform 0.2s ease;';
                }


                echo '<div
                    class="page-builder-button-wrapper page-builder-block"
                >';


                echo '<a
                    href="' .
                    e($buttonUrl) .
                    '"
                    class="page-builder-button"
                    style="' .
                    $buttonStyle .
                    '"
                >' .
                    e($buttonText) .
                '</a>';


                echo '</div>';

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | DIVIDER
            |--------------------------------------------------------------------------
            */

            if ($type === 'divider') {

                echo '<hr
                    class="page-builder-block page-builder-divider"
                    style="' .
                    $styleString .
                    '"
                >';

                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | ICON
            |--------------------------------------------------------------------------
            */

            if ($type === 'icon') {

                $icon =
                    $block['icon']
                    ?? 'bi-house';


                echo '<div
                    class="page-builder-block page-builder-icon"
                    style="' .
                    $styleString .
                    '"
                >';

                echo '<i
                    class="bi ' .
                    e($icon) .
                '"></i>';

                echo '</div>';

                continue;
            }
        }
    };

@endphp


{{-- =========================================================
     PUBLIC PAGE
========================================================= --}}

<div class="page-builder-public-page">

    <div class="page-builder-public-container">


        {{-- =================================================
             PAGE TITLE
        ================================================== --}}

        <header class="page-builder-page-header">

            <p class="page-builder-eyebrow">
                Page
            </p>

            <h1 class="page-builder-page-title">
                {{ $page->title ?? 'Page' }}
            </h1>

        </header>


        {{-- =================================================
             HEADER
        ================================================== --}}

        @if(!empty($headerBlocks))

            <section class="page-builder-header-section">

                <div class="page-builder-block-list">

                    @php
                        $renderBlocks(
                            $headerBlocks
                        );
                    @endphp

                </div>

            </section>

        @endif


        {{-- =================================================
             BODY + SIDE CONTENT
        ================================================== --}}

        <div
            class="{{
                $showSideContent
                    ? 'page-layout-with-sidebar'
                    : 'page-layout-full'
            }}"
        >


            {{-- =================================================
                 BODY
            ================================================== --}}

            <main class="page-main-content">

                @if(!empty($bodyBlocks))

                    <section class="page-builder-body-section">

                        <div class="page-builder-block-list">

                            @php
                                $renderBlocks(
                                    $bodyBlocks
                                );
                            @endphp

                        </div>

                    </section>

                @endif

            </main>


            {{-- =================================================
                 SIDE CONTENT
            ================================================== --}}

            @if($showSideContent)

                <aside class="page-side-content">

                    @if(!empty($sideBlocks))

                        <section class="page-builder-side-section">

                            <div class="page-builder-block-list">

                                @php
                                    $renderBlocks(
                                        $sideBlocks
                                    );
                                @endphp

                            </div>

                        </section>

                    @else

                        <div class="page-side-empty">
                            Side Content
                        </div>

                    @endif

                </aside>

            @endif


        </div>


        {{-- =================================================
             FOOTER
        ================================================== --}}

        @if(!empty($footerBlocks))

            <section class="page-builder-footer-section">

                <div class="page-builder-block-list">

                    @php
                        $renderBlocks(
                            $footerBlocks
                        );
                    @endphp

                </div>

            </section>

        @endif


    </div>

</div>


<style>

    /*
    |--------------------------------------------------------------------------
    | PAGE
    |--------------------------------------------------------------------------
    */

    .page-builder-public-page {
        width: 100%;
        min-height: 100vh;
        background: #F5F1E8;
        box-sizing: border-box;
        overflow-x: hidden;
    }


    .page-builder-public-container {
        width: 100%;
        max-width: 1280px;
        margin: 0 auto;
        padding: 40px 24px;
        box-sizing: border-box;
    }


    /*
    |--------------------------------------------------------------------------
    | PAGE HEADER
    |--------------------------------------------------------------------------
    */

    .page-builder-page-header {
        width: 100%;
        margin-bottom: 40px;
        box-sizing: border-box;
    }


    .page-builder-eyebrow {
        margin: 0;
        color: #B87945;
        font-size: 14px;
        line-height: 1.4;
        letter-spacing: .3em;
        text-transform: uppercase;
    }


    .page-builder-page-title {
        margin: 8px 0 0;
        color: #0F3F4A;
        font-size: 40px;
        line-height: 1.15;
        font-weight: 700;
        word-break: break-word;
    }


    /*
    |--------------------------------------------------------------------------
    | HEADER / BODY / FOOTER
    |--------------------------------------------------------------------------
    */

    .page-builder-header-section,
    .page-builder-body-section,
    .page-builder-side-section,
    .page-builder-footer-section {
        width: 100%;
        box-sizing: border-box;
    }


    /*
    |--------------------------------------------------------------------------
    | BLOCK LIST
    |--------------------------------------------------------------------------
    */

    .page-builder-block-list {
        width: 100%;
        display: flex;
        flex-direction: column;
        gap: 24px;
        box-sizing: border-box;
        min-width: 0;
    }


    /*
    |--------------------------------------------------------------------------
    | MAIN LAYOUT
    |--------------------------------------------------------------------------
    */

    .page-layout-full {
        width: 100%;
        min-width: 0;
        box-sizing: border-box;
    }


    .page-layout-with-sidebar {
        width: 100%;
        display: grid;
        grid-template-columns:
            minmax(0, 2fr)
            minmax(240px, 1fr);
        gap: 32px;
        align-items: start;
        box-sizing: border-box;
    }


    /*
    |--------------------------------------------------------------------------
    | MAIN CONTENT
    |--------------------------------------------------------------------------
    */

    .page-main-content {
        width: 100%;
        min-width: 0;
        box-sizing: border-box;
        overflow: hidden;
    }


    /*
    |--------------------------------------------------------------------------
    | SIDE CONTENT
    |--------------------------------------------------------------------------
    */

    .page-side-content {
        width: 100%;
        min-width: 0;
        box-sizing: border-box;
        overflow: hidden;
    }


    .page-side-empty {
        width: 100%;
        padding: 24px;
        background: #FFFFFF;
        border: 1px solid #D5DDD8;
        border-radius: 16px;
        box-sizing: border-box;
        color: #6B7280;
    }


    /*
    |--------------------------------------------------------------------------
    | GENERIC BLOCK
    |--------------------------------------------------------------------------
    */

    .page-builder-block {
        width: auto;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
    }


    /*
    |--------------------------------------------------------------------------
    | GROUP
    |--------------------------------------------------------------------------
    */

    .page-builder-group {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
        overflow: hidden;
    }


    .page-builder-group-label {
        width: 100%;
        color: #0F3F4A;
        font-size: 14px;
        line-height: 1.4;
        font-weight: 600;
        margin-bottom: 20px;
        box-sizing: border-box;
        word-break: break-word;
    }


    .page-builder-group-children {
        width: 100%;
        max-width: 100%;
        min-width: 0;

        display: flex;
        flex-direction: column;
        gap: 20px;

        box-sizing: border-box;
    }


    /*
    |--------------------------------------------------------------------------
    | TEXT
    |--------------------------------------------------------------------------
    */

    .page-builder-text {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
    }


    .page-builder-text-content {
        margin: 0;
        white-space: pre-line;
        line-height: 1.75;
        overflow-wrap: anywhere;
        word-break: break-word;
    }


    /*
    |--------------------------------------------------------------------------
    | HEADING
    |--------------------------------------------------------------------------
    */

    .page-builder-heading {
        max-width: 100%;
        margin-top: 0;
        margin-bottom: 0;
        line-height: 1.2;
        overflow-wrap: anywhere;
        word-break: break-word;
    }


    /*
    |--------------------------------------------------------------------------
    | IMAGE
    |--------------------------------------------------------------------------
    |
    | IMPORTANT:
    |
    | The wrapper controls available space.
    | The actual image controls width/height.
    |
    */

    .page-builder-image-wrapper {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
        overflow: hidden;

        display: block;
    }


    .page-builder-image {
        display: block;

        /*
         * Never allow an image to escape its content column.
         */
        max-width: 100%;
        max-height: 100%;

        /*
         * Width and height are supplied by the block's
         * saved style.
         */
        box-sizing: border-box;

        /*
         * Prevent image distortion.
         */
        object-fit: contain;

        /*
         * Keep normal image behavior when dimensions
         * are set to auto.
         */
        vertical-align: middle;

        border-radius: 12px;
    }


    /*
    |--------------------------------------------------------------------------
    | BUTTON
    |--------------------------------------------------------------------------
    */

    .page-builder-button-wrapper {
        width: 100%;
        max-width: 100%;
        min-width: 0;
        box-sizing: border-box;
    }


    .page-builder-button {
        position: relative;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        max-width: 100%;

        padding: 12px 20px;

        border-radius: 12px;

        background: #4F806D;
        color: #FFFFFF;

        font-weight: 600;

        text-decoration: none;

        box-sizing: border-box;

        overflow-wrap: anywhere;
    }


    .page-builder-button:hover {
        transform: translateY(-4px);
    }


    .page-builder-button:active {
        transform: translateY(-1px);
    }


    /*
    |--------------------------------------------------------------------------
    | DIVIDER
    |--------------------------------------------------------------------------
    */

    .page-builder-divider {
        width: 100%;
        max-width: 100%;

        margin: 0;

        border: 0;
        border-top: 1px solid #D5DDD8;

        box-sizing: border-box;
    }


    /*
    |--------------------------------------------------------------------------
    | ICON
    |--------------------------------------------------------------------------
    */

    .page-builder-icon {
        display: inline-flex;

        align-items: center;
        justify-content: center;

        max-width: 100%;

        box-sizing: border-box;
    }


    /*
    |--------------------------------------------------------------------------
    | FOOTER
    |--------------------------------------------------------------------------
    */

    .page-builder-footer-section {
        width: 100%;

        margin-top: 40px;
        padding-top: 32px;

        border-top: 1px solid #D5DDD8;

        box-sizing: border-box;
    }


    /*
    |--------------------------------------------------------------------------
    | MOBILE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 900px) {

        .page-builder-public-container {
            padding: 32px 18px;
        }


        .page-builder-page-title {
            font-size: 34px;
        }


        /*
         * Body and Side Content stack on smaller screens.
         */
        .page-layout-with-sidebar {
            grid-template-columns: 1fr;
            gap: 24px;
        }


        .page-side-content {
            width: 100%;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | SMALL MOBILE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 600px) {

        .page-builder-public-container {
            padding: 28px 16px;
        }


        .page-builder-page-title {
            font-size: 30px;
        }


        .page-builder-block-list {
            gap: 18px;
        }


        .page-builder-group-children {
            gap: 16px;
        }
    }

</style>

@endsection