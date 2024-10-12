<table class="w-full whitespace-no-wrap">
    <thead>
        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
            <th class="px-4 py-3">User</th>
            <th class="px-4 py-3">Login</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">IP Address</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
        @foreach($activity as $a)
        <tr class="text-gray-700 dark:text-gray-400">
            <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                    <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                        <img class="object-cover w-full h-full rounded-full" src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&amp;q=80&amp;fm=jpg&amp;crop=entropy&amp;cs=tinysrgb&amp;w=200&amp;fit=max&amp;ixid=eyJhcHBfaWQiOjE3Nzg0fQ" alt="" loading="lazy">
                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                    </div>
                    <div>
                        <p class="font-semibold">{{$a->user->name}}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400">
                            {{$a->user->organization->getRoot()->name_short}}
                        </p>
                    </div>
                </div>
            </td>
            <td class="px-4 py-3 text-sm">
                {{$a->created_at->toDayDateTimeString()}}
            </td>
            <td class="px-4 py-3 text-xs">
                <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                    
                </span>
            </td>
            <td class="px-4 py-3 text-sm">
                {{$a->ip_address}}
            </td>
        </tr>   
        @endforeach  
    </tbody>
</table>