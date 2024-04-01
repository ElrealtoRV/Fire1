
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            

        }

        .header-container h2 {
            margin-bottom: 20px;
            margin-top: 30px;
            
        }

        .form-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
            
        }

        .choices {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .generate {
            background: linear-gradient(to right, #3498db, #2e37a4);
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .box-info {
    background: linear-gradient(to right, #3498db, #2e37a4);
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    width: 100%; /* Initially, set the width to 100% */
    max-width: 1200px; /* Set a maximum width to prevent it from becoming too wide */

    /* Center the box horizontally */
    margin-left: auto;
    margin-right: auto;
}

@media screen and (min-width: 768px) {
    .toggle-element-active .box-info {
        width: calc(100% - 200px); /* Subtract the width of the toggle element from the available width */
    }
}

    
        .box {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .box i {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .box-info li:nth-child(1) i {
            color: orange;
        }

        .box-info li:nth-child(2) i {
            color: green;
        }

        .box-info li:nth-child(3) i {
            color: blue;
        }

        .box-info li:nth-child(4) i {
            color: red;
        }

        .box p {
            margin: 5px 0;
            font-weight: bold;
        }

        .chart-container {
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-gap: 20px;
            max-width: 1200px;
            max-height: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .chart-container .data {
            margin-bottom: 0;
            
        }

        @media (max-width: 768px) {
            .chart-container {
                grid-template-columns: 1fr;
            }
        }
    </style>


<body>
<div class="header-container">
        <h2>Fire Extinguisher Report</h2>
        <div class="form-row">
            <div class="choices">
                <label for="startDatePicker">Start Date:</label>
                <input type="date" id="startDatePicker" class="form-control">
            </div>
            <div class="choices">
                <label for="endDatePicker">End Date:</label>
                <input type="date" id="endDatePicker" class="form-control">
            </div>
            <button onclick="generateReport()" class="generate">Generate Report</button>
        </div>
</div>
    <ul class="box-info">
        <li>
            <i class="fas fa-fire-extinguisher"></i>
            <span class="text">
                @if($fires == 0)
                    <h3>{{ $fires }}</h3>
                    <p>Fire Extinguisher</p>
                @else
                    <h3>{{ $fires }}</h3>
                    <p>Fire Extinguisher{{ $fires != 1 ? 's' : '' }}</p>
                @endif
            </span>
        </li>
        <li>
            <i class="fas fa-users"></i>
            <span class="features">
                @if($regularusers == 0)
                    <h3>{{ $regularusers }}</h3>
                    <p>User</p>
                @else
                    <h3>{{ $regularusers }}</h3>
                    <p>User{{ $regularusers!= 1 ? 's' : '' }}</p>
                @endif
            </span>
        </li>
        <li>
            <i class="fas fa-briefcase"></i>
            <span class="features">
                @if($userCounts == 0)
                    <h3>{{ $userCounts }}</h3>
                    <p>Employee</p>
                @else
                    <h3>{{ $userCounts }}</h3>
                    <p>Employee{{ $userCounts != 1 ? 's' : '' }}</p>
                @endif
            </span>
        </li>
        <li>
            <i class="fas fa-fire-extinguisher"></i>
            <span class="features">
                <h3>2543</h3>
                <p>Expired Fire Extinguisher</p>
            </span>
        </li>
    </ul>
    <div class="chart-container">
        <div class="data">
            <canvas id="existingChart"></canvas>
        </div>
        <div class="data">
            <canvas id="expiredChart"></canvas>
        </div>
        <div class="data">
            <canvas id="employeeChart"></canvas>
        </div>
        <div class="data">
            <canvas id="userChart"></canvas>
        </div>
    </div>
    <script>
    function generateReport() {
        // Assuming you have logic here to generate the report
        // For now, let's just log a message to the console
        console.log("Report generated");
        
        // Now, update the charts based on the generated report
        updateCharts();
    }
    
    function updateCharts() {
        // Access Livewire component's data
        const fires = @json($fires);
        const userCounts = @json($userCounts);
        const regularusers = @json($regularusers);

        // Update the chart with Livewire data
        updateChart('existingChart', fires, 'Fire Extinguisher');
        updateChart('expiredChart', 0, 'Expired Fire Extinguisher'); // Provide dummy data if needed
        updateChart('employeeChart', userCounts, 'Employee');
        updateChart('userChart', regularusers, 'User');
    }

    function updateChart(chartId, value, label) {
        const ctx = document.getElementById(chartId).getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [label],
                datasets: [{
                    label: 'Count',
                    data: [value ],
                    backgroundColor: ['rgba(52, 152, 219, 0.2)'], // Adjusted color to match the gradient
                    borderColor: ['rgba(52, 152, 219, 1)'], // Adjusted color to match the gradient
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }
</script>
</body>

