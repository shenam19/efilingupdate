<div>
    <div class="flex flex-row my-2">
        <select wire:model="timeline" class="grow block w-1/2 mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
            <option value="today">Today</option>
            <option value="yesterday">Yesterday</option>
            <option value="this week">Last 7 days </option>
        </select>
    </div>
    
    <x-admin.line-chart 
        id="loginChart" 
        chartName="myChart"
        :label="$timeline" 
        borderColor="rgba(126,58,242,1)" 
        backgroundColor="white"
        :labels="$labels" 
        :chartData="$data" 
    />

</div>

