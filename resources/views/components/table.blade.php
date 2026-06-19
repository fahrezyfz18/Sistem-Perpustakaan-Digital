@props([
'headers' => [],
])

<div class="bg-white rounded-xl shadow overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead class="bg-primary text-white">
                <tr>

                    @foreach($headers as $header)
                    <th class="px-4 py-4 text-center">
                        {{ $header }}
                    </th>
                    @endforeach

                </tr>
            </thead>

            <tbody>

                {{ $slot }}

            </tbody>

        </table>

    </div>

</div>