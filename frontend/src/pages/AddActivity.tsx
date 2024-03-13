import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import DatePickerOne from '../components/Forms/DatePicker/DatePickerOne';
import MultiSelect from '../components/Forms/MultiSelect';
import SelectCompany from '../components/Forms/SelectGroup/SelectCompany';
import SelectGroupOne from '../components/Forms/SelectGroup/SelectGroupOne';
import SelectStatus from '../components/Forms/SelectGroup/SelectStatus';
import DefaultLayout from '../layout/DefaultLayout';

const AddActivity = () => {
  const [company, setCompany] = useState('');
  const [tanggal, setTanggal] = useState('');
  const [jenisHardware, setJenisHardware] = useState('');
  const [standartAplikasi, setStandartAplikasi] = useState('');
  const [uraianHardware, setUraianHardware] = useState('');
  const [uraianAplikasi, setUraianAplikasi] = useState('');
  const [aplikasiItTol, setAplikasiItTol] = useState('');
  const [uraianItTol, setUraianItTol] = useState('');
  const [catatan, setCatatan] = useState('');
  const [shift, setShift] = useState('');
  const [lokasi, setLokasi] = useState('');
  const [kategori, setKategori] = useState('');
  const [kondisiAkhir, setKondisiAkhir] = useState('');
  const [biaya, setBiaya] = useState('');
  const [foto, setFoto] = useState();
  const [status, setStatus] = useState('');
  const [selectedValues, setSelectedValues] = useState([]);
  const handleCompanyChange = (e: {
    target: { value: React.SetStateAction<string> };
  }) => {
    setCompany(e.target.value);
  };

  const handleTanggalChange = (date: React.SetStateAction<string>) => {
    setTanggal(date);
    console.log(date);
  };

  const handleJenisHardwareChange = (selected) => {
    setSelectedValues(selected);
    console.log(selected);
  };

  const handleStandartAplikasiChange = (e) => {
    setStandartAplikasi(e.target.value);
  };

  const handleUraianHardwareChange = (e) => {
    setUraianHardware(e.target.value);
  };

  const handleUraianAplikasiChange = (e) => {
    setUraianAplikasi(e.target.value);
  };

  const handleAplikasiItTolChange = (e) => {
    setAplikasiItTol(e.target.value);
  };

  const handleUraianItTolChange = (e) => {
    setUraianItTol(e.target.value);
  };

  const handleCatatanChange = (e) => {
    setCatatan(e.target.value);
  };

  const handleShiftChange = (e) => {
    setShift(e.target.value);
  };

  const handleLokasiChange = (e) => {
    setLokasi(e.target.value);
  };

  const handleKategoriChange = (e) => {
    setKategori(e.target.value);
  };

  const handleKondisiAkhirChange = (e) => {
    setKondisiAkhir(e.target.value);
  };

  const handleBiayaChange = (e) => {
    setBiaya(e.target.value);
  };

  const handleFotoChange = (e) => {
    setFoto(e.target.files[0]);
  };

  const handleStatusChange = (e) => {
    setStatus(e.target.value);
  };

  const handleAddActivity = async (e) => {
    e.preventDefault();

    const data = {
      company,
      tanggal,
      jenisHardware,
      standartAplikasi,
      uraianHardware,
      uraianAplikasi,
      aplikasiItTol,
      uraianItTol,
      catatan,
      shift,
      lokasi,
      kategori,
      kondisiAkhir,
      biaya,
      foto,
      status,
    };

    console.log(data);
  };

  const data = ['GTO', 'Gate barrier', 'LLA/OTL', 'CCTV', 'UPS', 'STB'];

  return (
    <DefaultLayout>
      <Breadcrumb pageName="Add Activity" />
      <div className="">
        <div className="flex flex-col gap-9">
          {/* <!-- Contact Form --> */}
          <div className="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div className="border-b border-stroke py-4 px-6.5 dark:border-strokedark">
              <h3 className="font-medium text-black dark:text-white">
                Contact Form
              </h3>
            </div>
            <form action="#">
              <div className="p-6.5">
                <div className="mb-4.5 flex gap-6 flex-col">
                  <SelectCompany
                    value={company}
                    onChange={handleCompanyChange}
                  />

                  <DatePickerOne
                    label={'Tanggal'}
                    value={tanggal}
                    onChange={handleTanggalChange}
                  />

                  <MultiSelect
                    id="multiSelect"
                    data={data}
                    label="Jenis Hardware"
                    value={jenisHardware}
                    onChange={handleJenisHardwareChange}
                  />

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Jenis Hardware
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={jenisHardware}
                      onChange={handleJenisHardwareChange}
                    />
                  </div>

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Standart Aplikasi
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={standartAplikasi}
                      onChange={handleStandartAplikasiChange}
                    />
                  </div>

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Uraian Hardware
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={uraianHardware}
                      onChange={handleUraianHardwareChange}
                    />
                  </div>

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Uraian Aplikasi
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={uraianAplikasi}
                      onChange={handleUraianAplikasiChange}
                    />
                  </div>

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Aplikasi IT Tol
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={aplikasiItTol}
                      onChange={handleAplikasiItTolChange}
                    />
                  </div>

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Uraian IT Tol
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={uraianItTol}
                      onChange={handleUraianItTolChange}
                    />
                  </div>

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Catatan
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={catatan}
                      onChange={handleCatatanChange}
                    />
                  </div>

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Shift
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={shift}
                      onChange={handleShiftChange}
                    />
                  </div>

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Lokasi
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={lokasi}
                      onChange={handleLokasiChange}
                    />
                  </div>

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Kategori
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      onChange={handleKategoriChange}
                      value={kategori}
                    />
                  </div>

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Kondisi Akhir
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={kondisiAkhir}
                      onChange={handleKondisiAkhirChange}
                    />
                  </div>

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Biaya
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={biaya}
                      onChange={handleBiayaChange}
                    />
                  </div>
                  <div>
                    <label className="mb-3 block text-black dark:text-white">
                      Foto
                    </label>
                    <input
                      type="file"
                      className="w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:py-3 file:px-5 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary"
                      onChange={handleFotoChange}
                    />
                  </div>

                  <SelectStatus value={status} onChange={handleStatusChange} />
                </div>

                <button
                  className="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray hover:bg-opacity-90"
                  onClick={handleAddActivity}
                >
                  Send Message
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </DefaultLayout>
  );
};

export default AddActivity;