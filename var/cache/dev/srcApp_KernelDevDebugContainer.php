<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container5woNCQA\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container5woNCQA/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container5woNCQA.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container5woNCQA\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \Container5woNCQA\srcApp_KernelDevDebugContainer([
    'container.build_hash' => '5woNCQA',
    'container.build_id' => '10026666',
    'container.build_time' => 1564156540,
], __DIR__.\DIRECTORY_SEPARATOR.'Container5woNCQA');
