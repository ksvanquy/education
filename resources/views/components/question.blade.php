  <section class="flex-1">
      <div class="space-y-4">
          <div class="bg-white rounded shadow p-4">
              <div class="flex items-center justify-between">
                  <span class="text-gray-500 text-xs">
                      {{ $subject ?? '' }} - {{ $grade ?? '' }} • {{ $time ?? '' }}
                  </span>
                  <span class="text-green-600 font-semibold">
                      {{ $status ?? '' }}
                  </span>
              </div>
              <div class="mt-2 text-gray-800">
                  <a href="{{ route('questions.show', $id) }}" class="hover:underline font-semibold text-blue-700">
                      {{ $question ?? '' }}
                  </a>
              </div>
              @if (isset($tags) && count($tags))
                  <div class="mb-2 mt-1">
                      @foreach ($tags as $tag)
                          <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mr-1 mb-1">
                              #{{ $tag->name }}
                          </span>
                      @endforeach
                  </div>
              @endif
              <div class="flex items-center gap-2 mt-2">
                  <form method="POST" action="{{ route('questions.vote', $id) }}">
                      @csrf
                      <input type="hidden" name="vote_type" value="up">
                      <button type="submit" class="text-green-500 font-bold">▲</button>
                  </form>
                  <span>{{ $votes ?? 0 }}</span>
                  <form method="POST" action="{{ route('questions.vote', $id) }}">
                      @csrf
                      <input type="hidden" name="vote_type" value="down">
                      <button type="submit" class="text-red-500 font-bold">▼</button>
                  </form>
              </div>
              <div class="mt-2 flex justify-end">
                  <a href="{{ route('questions.show', $id) }}" class="text-blue-500 hover:underline text-sm">Trả
                      lời</a>
              </div>
          </div>
      </div>
  </section>
