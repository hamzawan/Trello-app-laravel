<?php
function store_image($request, $file_name, $location)
{
    $name = time() . '_' . $request->file($file_name)->getClientOriginalName();
    $path = $request->file($file_name)->storeAs($location, str_replace(' ', '_', $name), 'public');
    return "/storage/". $path;
}
?>