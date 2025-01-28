<h1><?php echo e($title); ?></h1>

<?php if(empty($films)): ?>
    <FONT COLOR="red">No se ha encontrado ninguna película</FONT>
<?php else: ?>
    <div align="center">
    <table border="1">
        <tr>
            <?php $__currentLoopData = $films; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $film): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $__currentLoopData = array_keys($film); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($key); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php break; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>

        <?php $__currentLoopData = $films; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $film): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($film['name']); ?></td>
                <td><?php echo e($film['year']); ?></td>
                <td><?php echo e($film['genre']); ?></td>
                <td><img src=<?php echo e($film['img_url']); ?> style="width: 100px; heigth: 120px;" /></td>
                <td><?php echo e($film['country']); ?></td>
                <td><?php echo e($film['duration']); ?> minutos</td>
              </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </table>
</div>
<?php endif; ?><?php /**PATH C:\Users\hodeo\Documents\GitHub\laravel-learning\resources\views/films/list.blade.php ENDPATH**/ ?>