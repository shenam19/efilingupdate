Livewire.on('daily-logins', label => {
	console.log('test');
   	const lineConfig = {
		type: 'line',
		data: {
			labels: label,
			datasets: [
				{
					label: 'Login',
					/**
					 * These colors come from Tailwind CSS palette
					 * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
					 */
					backgroundColor: '#0694a2',
					borderColor: '#0694a2',
					data: [43, 48, 40, 54, 67, 73, 70],
					fill: false,
				},
				{
					label: 'Logout',
					fill: false,
					/**
					 * These colors come from Tailwind CSS palette
					 * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
					 */
					backgroundColor: '#7e3af2',
					borderColor: '#7e3af2',
					data: [24, 50, 64, 74, 52, 51, 65],
				},
			],
		},
		options: {
			responsive: true,
			/**
			 * Default legends are ugly and impossible to style.
			 * See examples in charts.html to add your own legends
			 *  */
			legend: {
				
			},
			tooltips: {
				mode: 'index',
				intersect: false,
			},
			hover: {
				mode: 'nearest',
				intersect: true,
			},
			scales: {
				x: {
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Month',
					},
				},
				y: {
					display: true,
					scaleLabel: {
						display: true,
						labelString: 'Value',
					},
				},
			},
		},
	}

	// change this to the id of your chart element in HMTL
	const lineCtx = document.getElementById('line')
	window.myLine = new Chart(lineCtx, lineConfig)
})

