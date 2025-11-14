

<?php $__env->startSection('content'); ?>
<div class="py-12">
    
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-12 text-gray-900 dark:text-gray-100">

                
                <h2 class="text-4xl font-semibold">
                    <?php echo e($vehicle->vehicleModel->brand->name); ?> 
                    <?php echo e($vehicle->vehicleModel->name); ?>

                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-400 mt-1">
                    <?php echo e($vehicle->color->name); ?> | <?php echo e($vehicle->year); ?>

                </p>

                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">

                    
                    <div>
                        
                        <div class="mb-4">
                            <img src="<?php echo e($vehicle->main_image_url); ?>" 
                                 class="w-full rounded-lg shadow-md"
                                 alt="Foto Principal">
                        </div>
                        
                        <h4 class="text-2xl font-semibold mb-4">Mais Imagens</h4>
                        <div class="grid grid-cols-3 gap-4">
                            <?php $__empty_1 = true; $__currentLoopData = $vehicle->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div>
                                    <img src="<?php echo e($image->url); ?>" 
                                         class="w-full rounded shadow" 
                                         alt="Foto Extra">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="col-span-3">
                                    <p class="text-gray-600 dark:text-gray-400">Este veículo não possui fotos extras.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div>
                        
                        <div class="mb-6">
                            <h3 class="text-6xl font-bold">
                                R$ <?php echo e(number_format($vehicle->price, 2, ',', '.')); ?>

                            </h3>
                        </div>

                        
                        <div class="border-y border-gray-200 dark:border-gray-700 text-lg">
                            <div class="flex justify-between py-4 px-2 border-b border-gray-200 dark:border-gray-700">
                                <strong class="text-gray-600 dark:text-gray-400">Quilometragem</strong>
                                <span class="font-semibold"><?php echo e(number_format($vehicle->mileage, 0, ',', '.')); ?> KM</span>
                            </div>
                            <div class="flex justify-between py-4 px-2 border-b border-gray-200 dark:border-gray-700">
                                <strong class="text-gray-600 dark:text-gray-400">Ano</strong>
                                <span class="font-semibold"><?php echo e($vehicle->year); ?></span>
                            </div>
                             <div class="flex justify-between py-4 px-2 border-b border-gray-200 dark:border-gray-700">
                                <strong class="text-gray-600 dark:text-gray-400">Cor</strong>
                                <span class="font-semibold"><?php echo e($vehicle->color->name); ?></span>
                            </div>
                             <div class="flex justify-between py-4 px-2 border-b border-gray-200 dark:border-gray-700">
                                <strong class="text-gray-600 dark:text-gray-400">Marca</strong>
                                <span class="font-semibold"><?php echo e($vehicle->vehicleModel->brand->name); ?></span>
                            </div>
                             <div class="flex justify-between py-4 px-2">
                                <strong class="text-gray-600 dark:text-gray-400">Modelo</strong>
                                <span class="font-semibold"><?php echo e($vehicle->vehicleModel->name); ?></span>
                            </div>
                        </div>

                        
                        <div class="mt-8">
                            <h5 class="text-2xl font-semibold mb-2">Descrição</h5>
                            <p class="text-gray-700 dark:text-gray-300 leading-relaxed text-lg">
                                <?php echo e($vehicle->description); ?>

                            </p>
                        </div>

                        
                        
                        <a href="<?php echo e(route('public.index')); ?>" class="inline-flex items-center px-6 py-3 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-sm text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150 mt-8">
                            &larr; Voltar para a lista
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CarStore\resources\views/public/show.blade.php ENDPATH**/ ?>