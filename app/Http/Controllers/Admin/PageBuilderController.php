<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PageBuilderController extends Controller
{
    /**
     * Show the page builder.
     */
    public function edit(string $slug)
    {
        /*
        |--------------------------------------------------------------------------
        | FIND OR CREATE PAGE
        |--------------------------------------------------------------------------
        */

        $page = Page::firstOrCreate(
            ['slug' => $slug],
            [
                'title' => ucfirst($slug),
                'content' => $this->defaultContent($slug),
                'builder_enabled' => false,
            ]
        );


        /*
        |--------------------------------------------------------------------------
        | NORMALIZE EXISTING CONTENT
        |--------------------------------------------------------------------------
        */

        $page->content = $this->normalizeContent(
            $page->content
        );


        return view(
            'admin.page-builder.edit',
            compact('page')
        );
    }


    /**
     * Save the page builder content.
     */
    public function update(Request $request, string $slug)
    {
        /*
        |--------------------------------------------------------------------------
        | FIND PAGE
        |--------------------------------------------------------------------------
        */

        $page = Page::where(
            'slug',
            $slug
        )->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'content' => [
                'nullable',
                'array',
            ],

            'images' => [
                'nullable',
                'array',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | GET SUBMITTED CONTENT
        |--------------------------------------------------------------------------
        */

        $content = $validated['content'] ?? [];


        /*
        |--------------------------------------------------------------------------
        | NORMALIZE CONTENT
        |--------------------------------------------------------------------------
        */

        $content = $this->normalizeContent(
            $content
        );


        /*
        |--------------------------------------------------------------------------
        | IMAGE UPLOADS
        |--------------------------------------------------------------------------
        */

        $uploadedImages =
            $request->file('images', []);


        if (!is_array($uploadedImages)) {
            $uploadedImages = [];
        }


        /*
        |--------------------------------------------------------------------------
        | VALIDATE IMAGES
        |--------------------------------------------------------------------------
        */

        $this->validateImageUploads(
            $uploadedImages
        );


        /*
        |--------------------------------------------------------------------------
        | PROCESS IMAGES
        |--------------------------------------------------------------------------
        */

        $this->processImageUploads(
            $content,
            $uploadedImages
        );


        /*
        |--------------------------------------------------------------------------
        | SAVE PAGE
        |--------------------------------------------------------------------------
        */

        $page->title =
            $validated['title'];


        $page->content =
            $content;


        /*
        |--------------------------------------------------------------------------
        | ENABLE PAGE BUILDER
        |--------------------------------------------------------------------------
        |
        | Saving through the Page Builder means the administrator
        | intentionally wants this page to use Page Builder.
        |
        */

        $page->builder_enabled = true;


        $page->save();


        /*
        |--------------------------------------------------------------------------
        | REDIRECT BACK TO BUILDER
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route(
                'admin.pages.edit',
                ['slug' => $slug]
            )
            ->with(
                'success',
                ucfirst($slug) .
                ' page has been saved successfully.'
            );
    }


    /**
     * Normalize Page Builder content.
     */
    private function normalizeContent($content): array
    {
        if (!is_array($content)) {
            $content = [];
        }


        /*
        |--------------------------------------------------------------------------
        | LAYOUT
        |--------------------------------------------------------------------------
        */

        if (
            !isset($content['layout']) ||
            !is_array($content['layout'])
        ) {
            $content['layout'] = [];
        }


        if (
            !array_key_exists(
                'show_side_content',
                $content['layout']
            )
        ) {
            $content['layout']['show_side_content'] =
                false;
        }


        /*
        |--------------------------------------------------------------------------
        | SECTIONS
        |--------------------------------------------------------------------------
        */

        $sections = [
            'header',
            'body',
            'side_content',
            'footer',
        ];


        foreach ($sections as $section) {

            if (
                !isset($content[$section]) ||
                !is_array($content[$section])
            ) {
                $content[$section] = [];
            }


            if (
                !isset($content[$section]['type'])
            ) {
                $content[$section]['type'] =
                    $section;
            }


            if (
                !isset($content[$section]['blocks']) ||
                !is_array($content[$section]['blocks'])
            ) {
                $content[$section]['blocks'] = [];
            }


            $content[$section]['blocks'] =
                $this->normalizeBlocks(
                    $content[$section]['blocks']
                );
        }


        return $content;
    }


    /**
     * Normalize a block collection.
     */
    private function normalizeBlocks($blocks): array
    {
        if (!is_array($blocks)) {
            return [];
        }


        $normalized = [];


        foreach ($blocks as $block) {

            if (!is_array($block)) {
                continue;
            }


            $type =
                $block['type'] ?? 'text';


            /*
            |--------------------------------------------------------------------------
            | COMMON BLOCK DATA
            |--------------------------------------------------------------------------
            */

            $cleanBlock = $block;

            $cleanBlock['type'] =
                $type;


            /*
            |--------------------------------------------------------------------------
            | STYLE
            |--------------------------------------------------------------------------
            */

            if (
                !isset($cleanBlock['style']) ||
                !is_array($cleanBlock['style'])
            ) {
                $cleanBlock['style'] = [];
            }


            /*
            |--------------------------------------------------------------------------
            | GROUP
            |--------------------------------------------------------------------------
            */

            if ($type === 'group') {

                if (
                    !isset($cleanBlock['children']) ||
                    !is_array($cleanBlock['children'])
                ) {
                    $cleanBlock['children'] = [];
                }


                $cleanBlock['children'] =
                    $this->normalizeBlocks(
                        $cleanBlock['children']
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | ADD BLOCK
            |--------------------------------------------------------------------------
            */

            $normalized[] =
                $cleanBlock;
        }


        return array_values(
            $normalized
        );
    }


    /**
     * Validate image uploads recursively.
     */
    private function validateImageUploads(
        array $uploadedImages
    ): void
    {
        foreach ($uploadedImages as $uploadedImage) {

            if (
                $uploadedImage instanceof UploadedFile
            ) {

                Validator::make(

                    ['image' => $uploadedImage],

                    [
                        'image' => [
                            'required',
                            'file',
                            'image',
                            'mimes:jpg,jpeg,png,webp',
                            'max:5120',
                        ],
                    ]

                )->validate();


                continue;
            }


            if (is_array($uploadedImage)) {

                $this->validateImageUploads(
                    $uploadedImage
                );

            }

        }
    }


    /**
     * Process image uploads recursively.
     */
    private function processImageUploads(
        array &$content,
        array $uploadedImages
    ): void
    {
        foreach (
            $content
            as $section => &$sectionContent
        ) {

            if (
                !is_array($sectionContent) ||
                !isset($sectionContent['blocks'])
            ) {
                continue;
            }


            $sectionFiles =
                $uploadedImages[$section] ?? [];


            if (!is_array($sectionFiles)) {
                $sectionFiles = [];
            }


            $this->processBlockImageUploads(
                $sectionContent['blocks'],
                $sectionFiles
            );
        }


        unset($sectionContent);
    }


    /**
     * Process images for blocks and nested groups.
     */
    private function processBlockImageUploads(
        array &$blocks,
        array $uploadedFiles
    ): void
    {
        foreach (
            $blocks
            as $index => &$block
        ) {

            if (!is_array($block)) {
                continue;
            }


            $uploadedFile =
                $uploadedFiles[$index] ?? null;


            /*
            |--------------------------------------------------------------------------
            | IMAGE BLOCK
            |--------------------------------------------------------------------------
            */

            if (
                ($block['type'] ?? null) === 'image' &&
                $uploadedFile instanceof UploadedFile
            ) {

                if ($uploadedFile->isValid()) {

                    /*
                    | Delete previous image.
                    */

                    $oldPath =
                        $block['path'] ?? null;


                    if ($oldPath) {

                        Storage::disk('public')
                            ->delete($oldPath);
                    }


                    /*
                    | Store new image.
                    */

                    $path =
                        $uploadedFile->store(
                            'page-images',
                            'public'
                        );


                    if ($path) {

                        $block['path'] =
                            $path;

                        unset(
                            $block['url']
                        );
                    }
                }
            }


            /*
            |--------------------------------------------------------------------------
            | GROUP CHILDREN
            |--------------------------------------------------------------------------
            */

            if (
                ($block['type'] ?? null) !== 'group' ||
                !isset($block['children'])
            ) {
                continue;
            }


            $childFiles = [];


            if (
                is_array($uploadedFile) &&
                isset($uploadedFile['children'])
            ) {

                $childFiles =
                    is_array(
                        $uploadedFile['children']
                    )
                        ? $uploadedFile['children']
                        : [];
            }


            if (
                is_array(
                    $block['children']
                )
            ) {

                $this->processBlockImageUploads(
                    $block['children'],
                    $childFiles
                );
            }
        }


        unset($block);
    }


    /**
     * Default layout for a new page.
     */
    private function defaultContent(
        string $slug
    ): array
    {
        return [

            'layout' => [

                'show_side_content' => false,

            ],


            'header' => [

                'type' => 'header',

                'blocks' => [],

            ],


            'body' => [

                'type' => 'body',

                'blocks' => [],

            ],


            'side_content' => [

                'type' => 'side_content',

                'blocks' => [],

            ],


            'footer' => [

                'type' => 'footer',

                'blocks' => [],

            ],

        ];
    }
}