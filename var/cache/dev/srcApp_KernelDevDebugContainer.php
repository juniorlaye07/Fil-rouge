<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerCBapf4k\srcApp_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerCBapf4k/srcApp_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerCBapf4k.legacy');

    return;
}

if (!\class_exists(srcApp_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerCBapf4k\srcApp_KernelDevDebugContainer::class, srcApp_KernelDevDebugContainer::class, false);
}

return new \ContainerCBapf4k\srcApp_KernelDevDebugContainer([
    'container.build_hash' => 'CBapf4k',
    'container.build_id' => 'f5ee608e',
    'container.build_time' => 1564506241,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerCBapf4k');
