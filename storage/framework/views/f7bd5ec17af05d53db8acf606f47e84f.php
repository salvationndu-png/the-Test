<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>LGA — Total Results</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

  <!-- Header -->
  <header class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <h1 class="text-lg font-semibold">LGA Total Results</h1>
        <span class="text-sm text-slate-500">Delta State</span>
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
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      <!-- Controls card -->
 
<form method="POST" action="<?php echo e(route('lga.results')); ?>">
    <?php echo csrf_field(); ?>
    <aside class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow p-6 border border-slate-200">
            <h2 class="text-md font-medium mb-2">Select LGA</h2>
            <p class="text-sm text-slate-500 mb-4">Choose an LGA to view total party results.</p>

            <label class="block text-xs font-medium text-slate-600 mb-2">LGA</label>
            <select name="lga_id" class="w-full border border-slate-200 rounded-lg px-3 py-2 bg-white" required>
              <option value="">-- Select LGA --</option>
              <?php $__currentLoopData = $lgas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lga): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($lga->uniqueid); ?>"
                  <?php if(isset($selectedLGA) && $selectedLGA == $lga->uniqueid): ?> selected <?php endif; ?>>
                  <?php echo e($lga->lga_name); ?>

                </option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <div class="mt-4 flex gap-3">
              <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-md shadow">
                Show LGA Totals
              </button>
         
            </div>
        </div>
    </aside>
</form>


      <!-- Results card -->
      <section class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow p-6 border border-slate-200 min-h-[260px]">
          <div class="flex items-start justify-between">
            <div>
              <h2 id="lgaTitle" class="text-xl font-semibold">
           
              </h2>
              <p id="lgaMeta" class="text-sm text-slate-500 mt-1">
                Select an LGA to view total party results.
              </p>
            </div>
          </div>

          <!-- Results table -->
          <div class="mt-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
              <thead class="bg-slate-50">
                <tr>
                  <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Party</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Total Score</th>
                </tr>
              </thead>

            <tbody class="bg-white divide-y divide-slate-100">
            <?php if(isset($results)): ?>
                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="px-4 py-3 text-sm font-medium"><?php echo e($result->party_abbreviation); ?></td>
                    <td class="px-4 py-3 text-sm"><?php echo e($result->party_score); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="2" class="px-4 py-3 text-sm text-center text-slate-500">
                        No results yet. Select an LGA to view totals.
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>


              <tfoot class="bg-slate-50">
                <tr>
                  <!-- <td class="px-4 py-3 text-sm font-medium">Grand Total</td> -->
                </tr>
              </tfoot>
            </table>
          </div>

        </div>
      </section>

    </div>
  </main>

  <!-- Footer -->
  <footer class="max-w-6xl mx-auto px-4 py-6 text-sm text-slate-500">
  </footer>

</body>
</html>
<?php /**PATH C:\Users\USER\Desktop\another\items\resources\views/lga.blade.php ENDPATH**/ ?>