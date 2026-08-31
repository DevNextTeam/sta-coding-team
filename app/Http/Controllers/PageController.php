<?php

namespace App\Http\Controllers;

use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a Page Builder page.
     *
     * If Page Builder is disabled for the page,
     * the original coded Blade page will be displayed.
     */
    public function show(string $slug)
    {
        /*
        |--------------------------------------------------------------------------
        | FIND THE PAGE
        |--------------------------------------------------------------------------
        */

        $page = Page::where('slug', $slug)->first();


        /*
        |--------------------------------------------------------------------------
        | FALLBACK TO CODED BLADE PAGE
        |--------------------------------------------------------------------------
        |
        | If the page does not exist OR Page Builder is disabled,
        | use the original Blade page.
        |
        */

        if (!$page || !$page->builder_enabled) {

            if ($slug === 'about') {
                return view('about');
            }

            if ($slug === 'contact') {
                return view('contact');
            }

            abort(404);
        }


        /*
        |--------------------------------------------------------------------------
        | GET PAGE BUILDER CONTENT
        |--------------------------------------------------------------------------
        */

        $content = $page->content;

        if (!is_array($content)) {
            $content = [];
        }


        /*
        |--------------------------------------------------------------------------
        | PAGE BUILDER SECTIONS
        |--------------------------------------------------------------------------
        */

        $sections = [
            'header',
            'body',
            'side_content',
            'footer',
        ];


        foreach ($sections as $section) {

            /*
            |--------------------------------------------------------------------------
            | Make sure the section exists.
            |--------------------------------------------------------------------------
            */

            if (
                !isset($content[$section]) ||
                !is_array($content[$section])
            ) {
                $content[$section] = [];
            }


            /*
            |--------------------------------------------------------------------------
            | Make sure blocks exist.
            |--------------------------------------------------------------------------
            */

            if (
                !isset($content[$section]['blocks']) ||
                !is_array($content[$section]['blocks'])
            ) {
                $content[$section]['blocks'] = [];
            }


            /*
            |--------------------------------------------------------------------------
            | Normalize blocks recursively.
            |--------------------------------------------------------------------------
            */

            $content[$section]['blocks'] =
                $this->normalizeBlocks(
                    $content[$section]['blocks']
                );
        }


        /*
        |--------------------------------------------------------------------------
        | ENSURE LAYOUT EXISTS
        |--------------------------------------------------------------------------
        */

        if (
            !isset($content['layout']) ||
            !is_array($content['layout'])
        ) {
            $content['layout'] = [];
        }


        /*
        |--------------------------------------------------------------------------
        | SIDE CONTENT
        |--------------------------------------------------------------------------
        */

        if (
            !array_key_exists(
                'show_side_content',
                $content['layout']
            )
        ) {

            $content['layout']['show_side_content'] =
                !empty(
                    $content['side_content']['blocks']
                );
        }


        /*
        |--------------------------------------------------------------------------
        | PUT NORMALIZED CONTENT BACK ON PAGE
        |--------------------------------------------------------------------------
        */

        $page->content = $content;


        /*
        |--------------------------------------------------------------------------
        | RENDER PAGE BUILDER PAGE
        |--------------------------------------------------------------------------
        */

        return view(
            'pages.show',
            [
                'page' => $page,
            ]
        );
    }


    /**
     * Normalize page builder blocks recursively.
     *
     * Groups remain as complete blocks and their children
     * are normalized recursively.
     */
    private function normalizeBlocks(array $blocks): array
    {
        $normalized = [];


        foreach ($blocks as $block) {

            /*
            |--------------------------------------------------------------------------
            | Ignore invalid blocks.
            |--------------------------------------------------------------------------
            */

            if (!is_array($block)) {
                continue;
            }


            /*
            |--------------------------------------------------------------------------
            | Make sure every block has a type.
            |--------------------------------------------------------------------------
            */

            $block['type'] =
                $block['type'] ?? 'text';


            /*
            |--------------------------------------------------------------------------
            | GROUP BLOCK
            |--------------------------------------------------------------------------
            */

            if ($block['type'] === 'group') {

                if (
                    !isset($block['children']) ||
                    !is_array($block['children'])
                ) {
                    $block['children'] = [];
                }


                /*
                |------------------------------------------------------------------
                | Normalize children recursively.
                |------------------------------------------------------------------
                */

                $block['children'] =
                    $this->normalizeBlocks(
                        $block['children']
                    );
            }


            /*
            |--------------------------------------------------------------------------
            | NORMALIZE STYLE
            |--------------------------------------------------------------------------
            */

            if (
                isset($block['style']) &&
                !is_array($block['style'])
            ) {
                $block['style'] = [];
            }


            if (!isset($block['style'])) {
                $block['style'] = [];
            }


            /*
            |--------------------------------------------------------------------------
            | DEFAULT TRANSITION
            |--------------------------------------------------------------------------
            */

            if (
                !isset($block['style']['transition']) ||
                !is_string($block['style']['transition'])
            ) {

                $block['style']['transition'] =
                    'transform 0.2s ease';
            }


            /*
            |--------------------------------------------------------------------------
            | KEEP BLOCK INTACT
            |--------------------------------------------------------------------------
            */

            $normalized[] = $block;
        }


        return array_values($normalized);
    }
}