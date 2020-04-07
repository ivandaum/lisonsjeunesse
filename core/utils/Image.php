<?php

namespace Lisonsjeunesse\Core\Utils;

class Image {
    public static $mimeType;
    public static $title;

    // main function, use create with ACF image (or image ID) to generate a html element with srcset
    public static function create($image, $padding = true) {
        if (is_int($image)) {
            $image = self::createFromId($image);

            if (!$image) {
                return "";
            }
        }

        self::$mimeType = $image['mime_type'];
        self::$title = $image['title'];

        $sources = array();
        $relations = array(
            '1279' => 'max',
            '999' => 'widescreen',
            '769' => 'phone',
            '360' => 'phone-s',
            '1' => '1x1',
        );

        foreach ($relations as $breakpoint => $imageName) {
            $sources[$breakpoint] = array(
                'src' => $image['sizes'][$imageName],
                'width' => $image['sizes'][$imageName . '-width'],
                'height' => $image['sizes'][$imageName . '-height'],
            );
        }

        return self::generateSrcset($sources);
    }

    public static function getRatio($image) {
        return $image['height'] / $image['width'];
    }

    public static function createThumbnail($image) {
        return self::create($image, array( '1' => '1x1', '360' => 'phone'));
    }

    public static function createFromId($id = null) {

        if ($id === null || !is_int($id)) {
            return false;
        }

        $metadata = wp_get_attachment_metadata($id);

        $image = array(
            'sizes' => array(),
            'url' => wp_get_attachment_url($id),
            'mime_type' => 'jpg',
            'title' => '',
            'height' => '',
            'width' => ''
        );

        if (isset($metadata['image_meta'])) {
            $image['mime_type'] = $metadata['image_meta']['title'];
            $image['title'] =  $metadata['image_meta']['title'];
        }

        if (isset($metadata['height'])) {
            $image['height'] = $metadata['height'];
        }

        if (isset($metadata['width'])) {
            $image['width'] = $metadata['width'];
        }

        $sizes = get_intermediate_image_sizes();
        for ($i = 0; $i < count($sizes); $i += 1) {
            $size = $sizes[$i];
            $src = wp_get_attachment_image_src( $id, $size );
            $image['sizes'][$size] = $src[0];
            $image['sizes'][$size . '-width'] = $src[1];
            $image['sizes'][$size . '-height'] = $src[2];
        }

        return $image;
    }

    public static function generateSrcset($sources = array()) {

        $last = array_values(array_slice($sources, -1))[0];

        $html = '';
        $html .= '<picture class="picture">';

        foreach($sources as $size => $image) {
            if ($size == '1') continue;
            $html .= '<source type="' . self::$mimeType . '"';
            $html .= ' media="(min-width: ' . $size . 'px)"';
            $html .= ' data-srcset="' . $image['src'] . '"';
            $html .= '></source>';
        }

        if (isset($last)) {
            $html .= '<img src="'. $sources['1']['src'] .'" data-src="' . $last['src'] . '" alt="' . self::$title . '" />';
        }
        $html .= '</picture>';
        return $html;
    }
}
