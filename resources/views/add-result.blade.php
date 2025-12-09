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
        <a class="hover:underline mr-4" href="{{url('/')}}">Polling Unit</a>
        <a class="hover:underline mr-4" href="{{url('lga')}}">LGA Total</a>
        <a class="hover:underline" href="{{url('add-result')}}">Add Result</a>
      </nav>
    </div>
  </header>

  <!-- Main -->
  <main class="max-w-6xl mx-auto mt-8 px-4 pb-12">
    <div class="bg-white rounded-2xl shadow p-6 border border-slate-200">

      @if(session('message'))
          <div 
              id="toast" 
              class="fixed top-5 right-5 bg-green-600 text-white px-4 py-3 rounded-lg shadow-lg 
                    flex items-start gap-3 animate-fadeIn"
          >
              <span>{{ session('message') }}</span>

              <button 
                  id="closeToast" 
                  class="text-white font-bold ml-2"
                  aria-label="Close"
              >
                  ✕
              </button>
          </div>

          <script>
              document.addEventListener("DOMContentLoaded", () => {
                  const toast = document.getElementById('toast');
                  const closeBtn = document.getElementById('closeToast');

                  closeBtn.addEventListener('click', () => {
                      toast.classList.add('opacity-0', 'scale-95');
                      setTimeout(() => toast.remove(), 300);
                  });
              });
          </script>

          <style>
              @keyframes fadeIn {
                  from { opacity: 0; transform: translateY(10px); }
                  to   { opacity: 1; transform: translateY(0); }
              }

              .animate-fadeIn {
                  animation: fadeIn 0.4s ease-out forwards;
              }
          </style>
      @endif




      <form method="POST" action="{{ route('store-result') }}">
        @csrf

        <!-- Polling Unit -->
        <div class="mb-4">
          <label class="block text-sm font-medium text-slate-700 mb-1">Polling Unit</label>
          <select name="polling_unit_uniqueid" class="w-full border border-slate-200 rounded-lg px-3 py-2" required>
            <option value="">-- Select Polling Unit --</option>
            @foreach($pollingUnitName as $unit)
              <option value="{{ $unit->polling_unit_id }}">{{ $unit->polling_unit_name }}</option>
            @endforeach
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

