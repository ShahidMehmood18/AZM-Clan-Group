<?php

if (!function_exists('image_url')) {
    /**
     * Return the correct image URL for a stored image path.
     * If the path is already an absolute URL (http/https), return it as-is.
     * Otherwise, treat it as a local path and use asset().
     */
    function image_url(?string $path, string $placeholder = 'https://via.placeholder.com/550x750'): string
    {
        if (empty($path)) {
            return $placeholder;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        return asset($path);
    }
}

if (!function_exists('product_image_url')) {
    /**
     * Alias for image_url() — backward compatibility.
     */
    function product_image_url(?string $path, string $placeholder = 'https://via.placeholder.com/550x750'): string
    {
        return image_url($path, $placeholder);
    }
}
