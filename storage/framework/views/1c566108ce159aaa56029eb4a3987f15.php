<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Add Polling Unit Result</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

  <!-- Header -->
  <header class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <h1 class="text-lg font-semibold">Add Polling Unit Result</h1>
      </div>
      <nav class="text-sm text-slate-600">
        <a class="hover:underline mr-4" href="<?php echo e(url('/')); ?>">Polling Unit</a>
        <a class="hover:underline mr-4" href="<?php echo e(url('lga')); ?>">LGA Total</a>
        <a class="hover:underline" href="<?php echo e(url('add-result')); ?>">Add Result</a>
      </nav>
    </div>
  </header>

  <!-- Main -->
  <main class="max-w-6xl mx-auto mt-8 px-4 pb-12">
    <div class="bg-white rounded-2xl shadow p-6 border border-slate-200">

        <?php if(session('message')): ?>
        <div 
            id="toast" 
            class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg opacity-0 transition-opacity duration-500"
        >
            <?php echo e(session('message')); ?>

        </div>

        <script>
            const toast = document.getElementById('toast');
            toast.classList.remove('opacity-0');
            toast.classList.add('opacity-100');

            setTimeout(() => {
            toast.classList.add('opacity-0');
            }, 3000); 
        </script>
        <?php endif; ?>


      <form method="POST" action="<?php echo e(route('store-result')); ?>">
        <?php echo csrf_field(); ?>

        <!-- Polling Unit -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-slate-700 mb-1">Polling Unit</label>
          <select name="polling_unit_uniqueid" class="w-full border border-slate-200 rounded-lg px-3 py-2" required>
            <option value="">-- Select Polling Unit --</option>
            <?php $__currentLoopData = $pollingUnitName; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($unit->polling_unit_id); ?>"><?php echo e($unit->polling_unit_name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        </div>

        <!-- Party -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-slate-700 mb-1">Party</label>
          <select name="party_abbreviation" class="w-full border border-slate-200 rounded-lg px-3 py-2" required>
            <option value="">-- Select Party --</option>
            <option value="PDP">PDP</option>
            <option value="DPP">DPP</option>
            <option value="ACN">ACN</option>
            <option value="PPA">PPA</option>
            <option value="CDC">CDC</option>
            <option value="JP">JP</option>
            <option value="ANPP">ANPP</option>
            <option value="LABOUR">LABOUR</option>
            <option value="CPP">CPP</option>
          </select>
        </div>

        <!-- Score -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-slate-700 mb-1">Score</label>
          <input type="number" name="party_score" min="0" class="w-full border border-slate-200 rounded-lg px-3 py-2" required>
        </div>

        <!-- Submit -->
        <div class="mt-6">
          <button type="submit" class="px-6 py-2 bg-sky-600 text-white rounded-md hover:bg-sky-700">Upload Result</button>
        </div>

      </form>
    </div>
  </main>
</body>
</html>
<?php /**PATH C:\Users\USER\Desktop\another\items\resources\views/add-result.blade.php ENDPATH**/ ?>