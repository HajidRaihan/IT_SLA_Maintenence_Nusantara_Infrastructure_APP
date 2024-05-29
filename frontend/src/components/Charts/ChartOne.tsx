import { ApexOptions } from 'apexcharts';
import React, { useState, useEffect } from 'react';
import ReactApexChart from 'react-apexcharts';
import { getAllActivityList } from '../../api/activityApi';

interface ActivityData {
  jenis_hardware: string;
  waktu_pengerjaan: string | null; // Assuming waktu_pengerjaan is a string in the API response
  // Add other fields from your API response here if needed
}

interface ChartOneState {
  categories: string[];
  series: { name: string; data: number[] }[];
  totalWaktuPengerjaan: number;
  averageWaktuPengerjaan: number;
  maxCategory: string;
  maxWaktuPengerjaan: number;
}

const options: ApexOptions = {
  chart: {
    fontFamily: 'Satoshi, sans-serif',
    type: 'area',
    height: 350,
    toolbar: {
      show: false,
    },
  },
  colors: ["#00008B", "#ADD8E6"],
  stroke: {
    curve: 'smooth',
  },
  dataLabels: {
    enabled: false,
  },
  xaxis: {
    categories: [],
  },
  yaxis: {
    title: {
      text: 'Total Waktu Pengerjaan (minutes)',
    },
  },
  fill: {
    type: 'gradient',
    gradient: {
      shadeIntensity: 1,
      opacityFrom: 0.7,
      opacityTo: 0.9,
    },
  },
  tooltip: {
    y: {
      formatter: (val: number) => `${val} minutes`,
    },
  },
};

const ChartOne: React.FC = () => {
  const [state, setState] = useState<ChartOneState>({
    categories: [],
    series: [
      {
        name: 'Waktu Pengerjaan',
        data: [],
      },
    ],
    totalWaktuPengerjaan: 0,
    averageWaktuPengerjaan: 0,
    maxCategory: '',
    maxWaktuPengerjaan: 0,
  });

  useEffect(() => {
    getAllActivityList()
      .then(res => {
        const data: ActivityData[] = res.data;
        const categoryTimeMap: Map<string, number> = new Map();
        let totalWaktuPengerjaan = 0;

        // Sum waktu_pengerjaan for each category and total
        data.forEach(item => {
          if (item.waktu_pengerjaan !== null) {
            const waktuPengerjaan = parseInt(item.waktu_pengerjaan, 10);
            totalWaktuPengerjaan += waktuPengerjaan;

            const categories = item.jenis_hardware.split(',').map(cat => cat.trim());
            categories.forEach(cat => {
              if (categoryTimeMap.has(cat)) {
                categoryTimeMap.set(cat, categoryTimeMap.get(cat)! + waktuPengerjaan);
              } else {
                categoryTimeMap.set(cat, waktuPengerjaan);
              }
            });
          }
        });

        // Convert map to arrays for ApexCharts
        const uniqueCategories = Array.from(categoryTimeMap.keys());
        const categoryTimes = uniqueCategories.map(cat => categoryTimeMap.get(cat)!);

        // Calculate average waktu pengerjaan
        const averageWaktuPengerjaan = totalWaktuPengerjaan / uniqueCategories.length;

        // Find category with max waktu pengerjaan
        let maxCategory = '';
        let maxWaktuPengerjaan = 0;
        categoryTimeMap.forEach((value, key) => {
          if (value > maxWaktuPengerjaan) {
            maxWaktuPengerjaan = value;
            maxCategory = key;
          }
        });

        setState({
          categories: uniqueCategories, // Set categories for x-axis
          series: [
            {
              name: 'Waktu Pengerjaan',
              data: categoryTimes,
            },
          ],
          totalWaktuPengerjaan, // Set total waktu pengerjaan
          averageWaktuPengerjaan, // Set average waktu pengerjaan
          maxCategory, // Set category with max waktu pengerjaan
          maxWaktuPengerjaan, // Set max waktu pengerjaan
        });
      })
      .catch(error => {
        console.error('Error fetching activity data:', error);
      });
  }, []);



  return (
    <div className="sm:px-7.5 col-span-12 rounded-sm border border-stroke bg-white px-5 pb-5 pt-7.5 shadow-default dark:border-strokedark dark:bg-boxdark xl:col-span-5">
      <div className="mb-3 justify-between gap-4 sm:flex">
        <div>
          <h5 className="text-xl font-semibold text-black dark:text-white">
            Hardware Performance
          </h5>
        </div>
        
      </div>

      <div className="mb-2">
        <div id="chartOne" className="mx-auto flex justify-center">
          <ReactApexChart
            options={{
              ...options,
              xaxis: {
                ...options.xaxis,
                categories: state.categories.map(String), // Ensure categories are strings
              },
            }}
            series={state.series}
            type="area"
            height={350}
          />
        </div>
      </div>

      <div className="mt-6">
        <h6 className="text-lg font-semibold text-black dark:text-white mb-2">Summary</h6>
        <div className="flex flex-wrap justify-between">

          <div className="w-full md:w-1/3 p-2">
            <div className="bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
              <h6 className="text-md font-medium text-black dark:text-white">Average Waktu Pengerjaan</h6>
              <p className="text-2xl font-bold text-blue-600">{state.averageWaktuPengerjaan.toFixed(2)} minutes</p>
            </div>
          </div>
          <div className="w-full md:w-1/3 p-2">
            <div className="bg-gray-100 dark:bg-gray-800 rounded-lg p-4">
              <h6 className="text-md font-medium text-black dark:text-white">Category with Max Waktu Pengerjaan</h6>
              <p className="text-2xl font-bold text-blue-600">{state.maxCategory}</p>
              <p className="text-md font-medium text-black dark:text-white">{state.maxWaktuPengerjaan} minutes</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ChartOne;
