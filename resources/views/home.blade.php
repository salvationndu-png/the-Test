<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Polling Unit — View Results</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

  <!-- Header -->
  <header class="bg-white border-b">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">
      <div class="flex items-center gap-4">
        <h1 class="text-lg font-semibold">Polling Unit Results</h1>
        <span class="text-sm text-slate-500">Delta State</span>
      </div>

      <nav class="text-sm text-slate-600">
        <a class="hover:underline mr-4" href="{{url('/')}}">Polling Unit</a>
        <a class="hover:underline mr-4" href="{{url('lga')}}">LGA Total</a>
        <a class="hover:underline" href="{{url('add-result')}}">Add Result</a>
      </nav>
    </div>
  </header>

  <!-- Main -->
  <main class="max-w-6xl mx-auto mt-8 px-4 pb-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      <!-- Controls card -->
      <form method="POST" action="{{ route('polling-unit.results') }}">
        @csrf
        <aside class="lg:col-span-1">
          <div class="bg-white rounded-2xl shadow p-6 border border-slate-200">
            <h2 class="text-md font-medium mb-2">Find a polling unit</h2>
            <p class="text-sm text-slate-500 mb-4">Select a polling unit below to view party results.</p>

            <label class="block text-xs font-medium text-slate-600 mb-2">Polling unit</label>
            <select name="polling_unit_id" class="w-full border border-slate-200 rounded-lg px-3 py-2 bg-white" required>
              <option value="">-- Select polling unit --</option>
              @foreach($pollingUnitName as $data)
                <option value="{{ $data->polling_unit_id }}"
                  @if(isset($selectedPU) && $selectedPU == $data->polling_unit_id) selected @endif>
                  {{ $data->polling_unit_name }}
                </option>
              @endforeach
            </select>

            <div class="mt-4 flex gap-3">
              <button type="submit" class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-md shadow">
                Show Results
              </button>

            </div>

            <div class="mt-4 text-sm text-slate-500">
              <!-- <div>State: <span class="font-medium">Delta (25)</span></div> -->
            </div>
          </div>
        </aside>
      </form>

      <!-- Results card -->
      <section class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow p-6 border border-slate-200 min-h-[260px]">
          <div class="flex items-start justify-between">
            <div>
              <h2 id="puTitle" class="text-xl font-semibold">
              </h2>
              <p id="puMeta" class="text-sm text-slate-500 mt-1">
                Select a polling unit to view detailed party results.
              </p>
            </div>

            <!-- <div class="flex gap-2 items-center">
              <button class="px-3 py-2 text-sm border border-slate-200 rounded-md hover:bg-slate-50">Export CSV</button>
              <button class="px-3 py-2 text-sm border border-slate-200 rounded-md hover:bg-slate-50">Print</button>
            </div> -->
          </div>

          <!-- Results table -->
          <div class="mt-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
              <thead class="bg-slate-50">
                <tr>
                  <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Party</th>
                  <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase">Score</th>
                </tr>
              </thead>

              <tbody class="bg-white divide-y divide-slate-100">
                @if(isset($results) && $results->count() > 0)
                  @foreach($results as $data)
                    <tr>
                      <td class="px-4 py-3 text-sm font-medium">{{ $data->party_abbreviation }}</td>
                      <td class="px-4 py-3 text-sm">{{ $data->party_score }}</td>
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td class="px-4 py-3 text-sm font-medium" colspan="2">
                      No results yet.
                    </td>
                  </tr>
                @endif
              </tbody>

              <tfoot class="bg-slate-50">
                <tr>
                  <td class="px-4 py-3 text-sm font-medium">Total</td>
                  <td class="px-4 py-3 text-sm font-medium">{{ $total ?? 0 }}</td>
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
