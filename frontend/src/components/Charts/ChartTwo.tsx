import { ApexOptions } from 'apexcharts';
import React, { useState, useEffect } from 'react';
import ReactApexChart from 'react-apexcharts';
import { getAllActivityList } from '../../api/activityApi';

interface ActivityData {
  jenis_hardware: string;
  // Add other fields from your API response here if needed
}

interface ChartThreeState {
  categories: string[];
  series: { name: string; data: number[] }[];
}

const options: ApexOptions = {
  chart: {
    fontFamily: 'Satoshi, sans-serif',
    type: 'bar',
    height: 350,
    toolbar: {
      show: false,
    },
  },
  colors: ["#00008B", "#ADD8E6"],
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: '55%',
      endingShape: 'rounded',
    },
  },
  dataLabels: {
    enabled: false,
  },
  xaxis: {
    categories: [],
  },
  yaxis: {
    title: {
      text: 'Count',
    },
  },
  fill: {
    opacity: 1,
  },
  tooltip: {
    y: {
      formatter: (val: number) => val.toString(),
    },
  },
};

const ChartTwo: React.FC = () => {
  const [state, setState] = useState<ChartThreeState>({
    categories: [],
    series: [
      {
        name: 'Count',
        data: [],
      },
    ],
  });

  useEffect(() => {
    getAllActivityList()
      .then(res => {
        const data: ActivityData[] = res.data;
        const categoryCountsMap: Map<string, number> = new Map();

        // Count occurrences of each category
        data.forEach(item => {
          const categories = item.jenis_hardware.split(',').map(cat => cat.trim());
          categories.forEach(cat => {
            if (categoryCountsMap.has(cat)) {
              categoryCountsMap.set(cat, categoryCountsMap.get(cat)! + 1);
            } else {
              categoryCountsMap.set(cat, 1);
            }
          });
        });

        // Convert map to arrays for ApexCharts
        const uniqueCategories = Array.from(categoryCountsMap.keys());
        const categoryCounts = uniqueCategories.map(cat => categoryCountsMap.get(cat)!);

        setState({
          categories: uniqueCategories, // Set categories for x-axis
          series: [
            {
              name: 'Count',
              data: categoryCounts,
            },
          ],
        });
      })
      .catch(error => {
        console.error('Error fetching activity data:', error);
      });
  }, []);

  const totalCategories = state.series[0].data.reduce((acc, curr) => acc + curr, 0);

  const handleReset = () => {
    setState({
      categories: [],
      series: [
        {
          name: 'Count',
          data: [],
        },
      ],
    });
  };

  return (
    <div className="sm:px-7.5 col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-5">
      <div className="mb-3 justify-between gap-4 sm:flex">
        <div>
          <h5 className="text-xl font-semibold text-black dark:text-white">
            Activity Categories
          </h5>
        </div>
        <div>
          <button onClick={handleReset} className="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md">
            Reset
          </button>
        </div>
      </div>

      <div className="mb-2">
        <div id="chartThree" className="mx-auto flex justify-center">
          <ReactApexChart
            options={{
              ...options,
              xaxis: {
                ...options.xaxis,
                categories: state.categories.map(String), // Ensure categories are strings
              },
            }}
            series={state.series}
            type="bar"
            height={350}
          />
        </div>
      </div>

      <div className="-mx-8 flex flex-wrap items-center justify-center gap-y-3">
        <div className="sm:w-1/3 w-full px-8">
          <div className="flex w-full items-center">
            <span className="mr-2 block h-3 w-full max-w-3 rounded-full bg-primary"></span>
            <p className="flex w-full justify-between text-sm font-medium text-black dark:text-white">
              <span> Categories </span>
              <span> {totalCategories} </span>
            </p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ChartTwo;