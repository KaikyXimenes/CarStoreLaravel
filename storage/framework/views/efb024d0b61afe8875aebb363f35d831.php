

<?php $__env->startSection('header'); ?>
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        <?php echo e(__('Adicionar Novo Veículo')); ?>

    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 md:p-10 text-gray-900 dark:text-gray-100">

                
                <?php if($errors->any()): ?>
                    <div class="mb-4 bg-red-600 text-white font-bold px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">Ups! Havia algo de errado com os dados:</span>
                        <ul class="mt-2 list-disc list-inside text-sm">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if(session('error')): ?>
                    <div class="mb-4 bg-red-600 text-white font-bold px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('admin.vehicles.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?> 
                    
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        
                        <div class="space-y-6">
                            
                            <div>
                                <label for="vehicle_model_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Modelo (Marca)</label>
                                <select id="vehicle_model_id" name="vehicle_model_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">-- Selecione um Modelo --</option>
                                    <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($model->id); ?>" <?php echo e(old('vehicle_model_id') == $model->id ? 'selected' : ''); ?>>
                                            <?php echo e($model->brand->name); ?> - <?php echo e($model->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            
                            <div>
                                <label for="color_id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Cor</label>
                                <select id="color_id" name="color_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                                    <option value="">-- Selecione uma Cor --</option>
                                    <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($color->id); ?>" <?php echo e(old('color_id') == $color->id ? 'selected' : ''); ?>>
                                            <?php echo e($color->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            
                            
                            <div>
                                <label for="description" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Descrição (Detalhes)</label>
                                <textarea id="description" name="description" rows="5" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required><?php echo e(old('description')); ?></textarea>
                            </div>
                        </div>

                        
                        <div class="space-y-6">
                            
                            <div>
                                <label for="year" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Ano de Fabricação</label>
                                <input type="number" id="year" name="year" value="<?php echo e(old('year')); ?>" required placeholder="Ex: 2023"
                                       class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </div>

                            
                            <div>
                                <label for="mileage" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Quilometragem (KM)</label>
                                <input type="number" id="mileage" name="mileage" value="<?php echo e(old('mileage')); ?>" required placeholder="Ex: 15000"
                                       class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </div>

                            
                            <div>
                                <label for="price" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Valor (R$)</label>
                                <input type="number" id="price" name="price" value="<?php echo e(old('price')); ?>" step="0.01" required placeholder="Ex: 82000.00"
                                       class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            </div>
                        </div>
                    </div>

                    <hr class="my-6 border-gray-200 dark:border-gray-700">
                    
                    <h5 class="text-xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Fotos (URLs)</h5>
                    
                    
                    <div class="mb-4">
                        <label for="main_image_url" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Foto Principal (URL)</label>
                        <input type="url" id="main_image_url" name="main_image_url" value="<?php echo e(old('main_image_url')); ?>" required placeholder="https://.../foto_principal.jpg"
                               class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    </div>

                    
                    <div class="mb-4">
                        <label class="block font-medium text-sm text-gray-700 dark:text-gray-300">Fotos Extras (URLs) - Mínimo 3</label>
                        <div id="image-inputs-container" class="mt-2 space-y-2">
                            <input type="url" name="images[]" value="<?php echo e(old('images.0')); ?>" placeholder="https://.../foto_extra_1.jpg" required
                                   class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <input type="url" name="images[]" value="<?php echo e(old('images.1')); ?>" placeholder="https://.../foto_extra_2.jpg" required
                                   class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <input type="url" name="images[]" value="<?php echo e(old('images.2')); ?>" placeholder="https://.../foto_extra_3.jpg" required
                                   class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            
                            
                            <?php if(old('images') && count(old('images')) > 3): ?>
                                <?php for($i = 3; $i < count(old('images')); $i++): ?>
                                    <input type="url" name="images[]" value="<?php echo e(old('images.'.$i)); ?>" placeholder="https://.../foto_extra_<?php echo e($i + 1); ?>.jpg" required
                                           class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <?php endfor; ?>
                            <?php endif; ?>
                        </div>
                        
                        
                        <button type="button" id="add-image-input" class="inline-flex items-center mt-2 px-3 py-1 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 active:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            + Adicionar mais uma foto
                        </button>
                    </div>
                    
                    
                    <div class="flex items-center justify-end mt-6">
                        <a href="<?php echo e(route('admin.vehicles.index')); ?>" class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ms-4">
                            Guardar Veículo
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addButton = document.getElementById('add-image-input');
        const container = document.getElementById('image-inputs-container');
        addButton.addEventListener('click', function () {
            // Cria um novo 'input'
            const newInput = document.createElement('input');
            newInput.setAttribute('type', 'url');
            // Adiciona as classes do Tailwind (copiadas dos inputs acima)
            newInput.setAttribute('class', 'block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm');
            newInput.setAttribute('name', 'images[]');
            newInput.setAttribute('placeholder', 'https://.../outra_foto.jpg');
            newInput.setAttribute('required', true);
            
            // Adiciona o 'input' novo ao "contentor"
            container.appendChild(newInput);
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\CarStore\resources\views/admin/vehicles/create.blade.php ENDPATH**/ ?>