@props([
    'headers' => [],
])

<div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

    <di v class="overflow-x-auto">

       <table class="w-full text-sm text-gray-700">

            <thead class="bg-primary text-white">
                <tr>
                  @foreach($headers as $header)
                    <th class="px-6 py-4 text-center font-semibold tracking-wide">
                            {{ $header }}
                        </th>
                @endforeach

                </tr>
            </thead>

            <tbody>

                {{ $slot }}

            </tbody>

        </table>

    </di>

</div>