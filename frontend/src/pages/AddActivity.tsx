import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import Breadcrumb from '../components/Breadcrumbs/Breadcrumb';
import DatePickerOne from '../components/Forms/DatePicker/DatePickerOne';
import MultiSelect from '../components/Forms/MultiSelect';
import SelectCompany from '../components/Forms/SelectGroup/SelectCompany';
import SelectGroupOne from '../components/Forms/SelectGroup/SelectGroupOne';
import SelectStatus from '../components/Forms/SelectGroup/SelectStatus';
import DefaultLayout from '../layout/DefaultLayout';
import { getLokasi } from '../api/lokasiApi';
import { getKategori } from '../api/kategoriApi';
import { addActivity } from '../api/activityApi';
import MultiSelectAplikasi from '../components/Forms/MultiSelectAplikasi';
import CheckboxTwo from '../components/Checkboxes/CheckboxTwo';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faPlus } from '@fortawesome/free-solid-svg-icons';

const AddActivity = () => {
  const [company, setCompany] = useState('');
  const [tanggal, setTanggal] = useState('');
  const [jenisHardware, setJenisHardware] = useState([]);
  const [standartAplikasi, setStandartAplikasi] = useState([]);
  const [uraianHardware, setUraianHardware] = useState('');
  const [uraianAplikasi, setUraianAplikasi] = useState('');
  const [aplikasiItTol, setAplikasiItTol] = useState([]);
  const [uraianItTol, setUraianItTol] = useState('');
  const [catatan, setCatatan] = useState('');
  const [shift, setShift] = useState('');
  const [lokasi, setLokasi] = useState('');
  const [kategori, setKategori] = useState('');
  const [kondisiAkhir, setKondisiAkhir] = useState('');
  const [biaya, setBiaya] = useState('');
  const [foto, setFoto] = useState();
  const [status, setStatus] = useState('');
  const [lokasiData, setLokasiData] = useState();
  const [kategoriData, setKategoriData] = useState();

  useEffect(() => {
    const fetchLokasi = async () => {
      const res = await getLokasi();
      console.log(res);
      setLokasiData(res);
    };
    fetchLokasi();
  }, []);

  useEffect(() => {
    const fetchKategori = async () => {
      const res = await getKategori();
      console.log(res);
      setKategoriData(res);
    };
    fetchKategori();
  }, []);

  const handleCompanyChange = (e: {
    target: { value: React.SetStateAction<string> };
  }) => {
    setCompany(e.target.value);
  };

  const handleTanggalChange = (e) => {
    setTanggal(e.target.value);
    console.log(e.target.value);
  };

  // const handleJenisHardwareChange = (selected) => {
  //   setJenisHardware(selected);
  //   console.log(selected);
  // };
  const handleJenisHardwareChange = (value) => {
    console.log(value);
    console.log(jenisHardware);
    // Cek apakah value sudah ada dalam array checkedValues
    if (jenisHardware.includes(value)) {
      // Jika sudah ada, hapus dari array
      console.log(true);
      setJenisHardware(jenisHardware.filter((item) => item !== value));
    } else {
      // Jika belum ada, tambahkan ke array
      setJenisHardware([...jenisHardware, value]);
    }
  };

  const handleStandartAplikasiChange = (value) => {
    console.log(value);
    console.log(jenisHardware);
    // Cek apakah value sudah ada dalam array checkedValues
    if (standartAplikasi.includes(value)) {
      // Jika sudah ada, hapus dari array
      console.log(true);
      setStandartAplikasi(standartAplikasi.filter((item) => item !== value));
    } else {
      // Jika belum ada, tambahkan ke array
      setStandartAplikasi([...standartAplikasi, value]);
    }
  };

  const handleUraianHardwareChange = (e) => {
    setUraianHardware(e.target.value);
  };

  const handleUraianAplikasiChange = (e) => {
    setUraianAplikasi(e.target.value);
  };

  // const handleAplikasiItTolChange = (selected) => {
  //   setAplikasiItTol(selected);
  // };

  const handleAplikasiItTolChange = (value) => {
    if (aplikasiItTol.includes(value)) {
      // Jika sudah ada, hapus dari array
      setAplikasiItTol(aplikasiItTol.filter((item) => item !== value));
    } else {
      // Jika belum ada, tambahkan ke array
      setAplikasiItTol([...aplikasiItTol, value]);
    }
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
      user_id: 1,
      company: company,
      tanggal: tanggal,
      jenis_hardware: jenisHardware.join(', '),
      standart_aplikasi: standartAplikasi.join(', '),
      uraian_hardware: uraianHardware,
      uraian_aplikasi: uraianAplikasi,
      aplikasi_it_tol: aplikasiItTol.join(', '),
      uraian_it_tol: uraianItTol,
      catatan: catatan,
      shift: shift,
      lokasi_id: lokasi,
      kategori_id: kategori,
      kondisi_akhir: kondisiAkhir,
      biaya: biaya,
      fotos: foto,
      status: status,
    };

    console.log(data);
    try {
      const res = await addActivity(data);
      console.log(res);
    } catch (error) {
      console.error(error);
    }
  };

  const dataJenisHardware = [
    // 'GTO',
    'Gate barrier',
    'LLA/OTL',
    'CCTV',
    'UPS',
    'STB',
  ];

  const dataAplikasiTol = [
    'Program LTCS/TFI',
    'Program PCS',
    'Program RTM',
    'Program CCTV/VMS',
  ];


  const dataStandartAplikasi = ['Sistem Operasi', 'Microsoft Office'];

  const dataCompany = ['MMN', 'JTSE'];

  return (
    <DefaultLayout>
      <Breadcrumb pageName="Add Activity" />
      <div className="">
        <div className="flex flex-col gap-9">
          <div className="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <form action="#">
              <div className="p-6.5">
                <div className="mb-4.5 flex gap-6 flex-col">
                  {/* <SelectCompany
                    value={company}
                    onChange={handleCompanyChange}
                  /> */}

                  <SelectCompany
                    label="Company"
                    data={dataCompany}
                    value={company}
                    onChange={handleCompanyChange}
                  />

                  <DatePickerOne
                    label={'Tanggal'}
                    value={tanggal}
                    onChange={handleTanggalChange}
                  />

                  {/* <MultiSelect
                    id="multiSelect"
                    data={dataJenisHardware}
                    label="Jenis Hardware"
                    value={jenisHardware}
                    onChange={handleJenisHardwareChange}
                  /> */}

                  <div>
                    <label className="mb-2.5 block text-black dark:text-white">
                      Jenis Hardware
                    </label>
                    <div className="flex gap-10 flex-wrap">
                      {dataJenisHardware.map((data, index) => {
                        return (
                          <CheckboxTwo
                            label={data}
                            key={index}
                            isChecked={jenisHardware.includes(data)} // Pass nilai isChecked berdasarkan apakah label ada dalam checkedValues
                            onChange={() => handleJenisHardwareChange(data)} // Gunakan handleCheckboxChange sebagai onChange handler
                            options={dataJenisHardware}
                          />
                        );
                      })}
                    </div>
                  </div>

                  <div className="w-full ">
                    <textarea
                      // type="text-area"
                      className="w-full h-40 rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      placeholder="Penjabaran Masalah Hardware"
                      value={uraianHardware}
                      onChange={handleUraianHardwareChange}
                    />
                  </div>

                  {/* <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Standart Aplikasi
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={standartAplikasi}
                      onChange={handleStandartAplikasiChange}
                    />
                  </div> */}

                  <div>
                    <label className="mb-2.5 block text-black dark:text-white">
                      Standard Aplikasi
                    </label>
                    <div className="flex gap-10 flex-wrap">
                      {dataStandartAplikasi.map((data, index) => {
                        return (
                          <CheckboxTwo
                            label={data}
                            key={index}
                            isChecked={standartAplikasi.includes(data)} // Pass nilai isChecked berdasarkan apakah label ada dalam checkedValues
                            onChange={() => handleStandartAplikasiChange(data)} // Gunakan handleCheckboxChange sebagai onChange handler
                            options={dataStandartAplikasi}
                          />
                        );
                      })}
                    </div>
                  </div>

                  <div className="w-full ">
                    <textarea
                      className="h-40 w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      placeholder="Penjabaran Masalah Sistem"
                      value={uraianAplikasi}
                      onChange={handleUraianAplikasiChange}
                    />
                  </div>

                  {/* <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Aplikasi IT Tol
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      value={aplikasiItTol}
                      onChange={handleAplikasiItTolChange}
                    />
                  </div> */}

                  {/* <MultiSelectAplikasi
                    id="multiSelect"
                    data={dataAplikasiTol}
                    label="Aplikasi IT dan Peralatan Tol"
                    value={aplikasiItTol}
                    onChange={handleAplikasiItTolChange}
                  /> */}
                  {/* 
                  <div>
                    <label className="mb-2.5 block text-black dark:text-white">
                      Jenis Hardware
                    </label>
                    <div className="flex gap-10 flex-wrap">
                      {dataAplikasiTol.map((data, index) => {
                        return <CheckboxTwo label={data} key={index} />;
                      })}
                    </div>
                  </div> */}

                  <div>
                    <label className="mb-2.5 block text-black dark:text-white">
                      Aplikasi IT dan Peralatan Tol
                    </label>
                    <div className="flex gap-10 flex-wrap">
                      {dataAplikasiTol.map((data, index) => {
                        return (
                          <CheckboxTwo
                            label={data}
                            key={index}
                            isChecked={aplikasiItTol.includes(data)} // Perbarui prop isChecked
                            onChange={() => handleAplikasiItTolChange(data)} // Perbarui prop onChange
                            options={aplikasiItTol}
                          />
                        );
                      })}
                    </div>
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
                      placeholder="Catatan jika diperlukan"
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

                  <SelectGroupOne
                    value={lokasi}
                    onChange={handleLokasiChange}
                    label="Lokasi"
                    data={lokasiData}
                  />

                  <SelectGroupOne
                    value={kategori}
                    onChange={handleKategoriChange}
                    label="Kategori"
                    data={kategoriData}
                  />

                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Kondisi Akhir
                    </label>
                    <textarea
                      className="h-40 w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      placeholder="Kondisi Akhir"
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
                      placeholder="example: 80.000"
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
                  Submit
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
