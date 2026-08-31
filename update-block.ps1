$file = "resources\views\admin\page-builder\block.blade.php"

$content = Get-Content $file -Raw

# ---------------------------------------------------------
# 1. Add reusable field prefixes
# ---------------------------------------------------------

$content = $content.Replace(
'@php

    $type = $block[''type''] ?? ''text'';',
'@php

    $namePrefix = $namePrefix
        ?? "content[{$section}][blocks][{$index}]";

    $imagePrefix = $imagePrefix
        ?? "images[{$section}][{$index}]";

    $type = $block[''type''] ?? ''text'';'
)

# ---------------------------------------------------------
# 2. Replace normal block field prefixes
# ---------------------------------------------------------

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][text]"',
'name="{{ $namePrefix }}[text]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][url]"',
'name="{{ $namePrefix }}[url]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][type]"',
'name="{{ $namePrefix }}[type]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][icon]"',
'name="{{ $namePrefix }}[icon]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][color]"',
'name="{{ $namePrefix }}[style][color]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][background]"',
'name="{{ $namePrefix }}[style][background]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][font_size]"',
'name="{{ $namePrefix }}[style][font_size]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][font_weight]"',
'name="{{ $namePrefix }}[style][font_weight]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][text_align]"',
'name="{{ $namePrefix }}[style][text_align]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][width]"',
'name="{{ $namePrefix }}[style][width]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][height]"',
'name="{{ $namePrefix }}[style][height]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][padding]"',
'name="{{ $namePrefix }}[style][padding]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][margin]"',
'name="{{ $namePrefix }}[style][margin]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][border]"',
'name="{{ $namePrefix }}[style][border]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][radius]"',
'name="{{ $namePrefix }}[style][radius]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][shadow]"',
'name="{{ $namePrefix }}[style][shadow]"'
)

$content = $content.Replace(
'name="content[{{ $section }}][blocks][{{ $index }}][style][transition]"',
'name="{{ $namePrefix }}[style][transition]"'
)

# ---------------------------------------------------------
# 3. Replace image field
# ---------------------------------------------------------

$content = $content.Replace(
'name="images[{{ $section }}][{{ $index }}]"',
'name="{{ $imagePrefix }}"'
)

# ---------------------------------------------------------
# 4. Add Group block before TEXT BLOCK
# ---------------------------------------------------------

$group = @'
        {{-- =====================================================
             GROUP / CONTAINER BLOCK
        ====================================================== --}}

        @if($type === 'group')

            <div class="group-block-content">

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
                    Drag Text, Heading, Image, Button, Icon,
                    Divider, or another Group into this container.
                </p>

                <div
                    class="group-drop-zone drop-zone"
                    data-group-zone="true"
                    data-section="{{ $section }}"
                >

                    @foreach(($block['children'] ?? []) as $childIndex => $childBlock)

                        @include(
                            'admin.page-builder.block',
                            [
                                'block' => $childBlock,
                                'section' => $section,
                                'index' => $childIndex,

                                'namePrefix' =>
                                    $namePrefix . '[children][' . $childIndex . ']',

                                'imagePrefix' =>
                                    $imagePrefix . '[children][' . $childIndex . ']'
                            ]
                        )

                    @endforeach

                    @if(empty($block['children']))

                        <div class="empty-zone">
                            Drop components into this group
                        </div>

                    @endif

                </div>

                <input
                    type="hidden"
                    name="{{ $namePrefix }}[type]"
                    value="group"
                >

            </div>

        @endif


'@

$marker = @'
        {{-- =====================================================
             TEXT BLOCK
        ====================================================== --}}
'@

$content = $content.Replace(
    $marker,
    $group + $marker
)

# ---------------------------------------------------------
# 5. Add Group to block header
# ---------------------------------------------------------

$content = $content.Replace(
'''                @elseif($type === 'icon')
                    <i class="bi bi-stars mr-1"></i>
                    Icon Block
                @endif''',
'''                @elseif($type === 'icon')
                    <i class="bi bi-stars mr-1"></i>
                    Icon Block
                @elseif($type === 'group')
                    <i class="bi bi-collection mr-1"></i>
                    Group / Container
                @endif'''
)

# ---------------------------------------------------------
# 6. Add styling directly to this file
# ---------------------------------------------------------

$style = @'
<style>
.group-block-content {
    padding: 14px;
    border: 2px dashed #BFD8CE;
    border-radius: 12px;
    background: #F7FAF8;
}

.group-drop-zone {
    min-height: 100px;
    margin-top: 12px;
    padding: 12px;
    border: 1px dashed #C8D8D1;
    border-radius: 10px;
    background: white;
}

.group-drop-zone.drag-over {
    background: #E5EEF0;
    outline: 2px dashed #4F806D;
    outline-offset: -5px;
}

.group-drop-zone .builder-block {
    background: #FAFAF8;
}

.group-drop-zone .empty-zone {
    padding: 20px;
}
</style>

'@

$content = $style + $content

# ---------------------------------------------------------
# 7. Save
# ---------------------------------------------------------

Set-Content `
    -Path $file `
    -Value $content `
    -Encoding UTF8

Write-Host ""
Write-Host "block.blade.php has been updated successfully." -ForegroundColor Green
Write-Host ""
Write-Host "File:" $file
Write-Host "Size:" ((Get-Item $file).Length) "bytes"