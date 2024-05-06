import React, { useState, useEffect } from 'react';
import { CSSProperties } from 'react';
import {
  Modal,
  ModalContent,
  ModalHeader,
  ModalBody,
  ModalFooter,
  Button,
  Input,
  // select,
  // Dropdown,
  // DropdownTrigger,
  // DropdownMenu,
  // DropdownItem,
} from '@nextui-org/react';

const modalStyles = {
  maxHeight: 'calc(100vh - 100px)', 
  overflowY: 'auto', 
};
import { getLokasi } from '../../api/lokasiApi.js';

function AddStuffModal({ isOpen, onClose, onAdd, value, onChange, title }) {
  return (
    <>
      <Modal isOpen={isOpen} onClose={onClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="mb-2.5 block text-black dark:text-white">
              {title}
            </ModalHeader>
            <ModalBody>
              <Input
                autoFocus
                value={value}
                onChange={onChange}
                className=" bg-transparent p text-black  transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                label={title}
                placeholder={`Enter your  + ${title}`}
                variant="bordered"
              />
            </ModalBody>
            <ModalFooter>
              <Button color="danger" variant="flat" onPress={onClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Add
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

function BarangModal({
  isOpen,
  onClose,
  onAdd,
  onChangeEquipment,
  onChangeMerk,
  onChangeStock,
  onChangePicture,
  onChangeCompany,
  valueEquipment,
  valueMerk,
  valueStock,
  valueCompany,
}) {
  return (
    <>
      <Modal isOpen={isOpen} onClose={onClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">
              Add Barang
            </ModalHeader>
            <ModalBody>
              <div className="flex flex-wrap gap-4">
                <div className="w-full sm:w-1/2 md:w-1/3">
                  <ModalHeader className="mb-2.5 block text-black dark:text-white">
                    Equipment
                  </ModalHeader>
                  <Input
                    autoFocus
                    value={valueEquipment}
                    onChange={onChangeEquipment}
                    placeholder="Enter equipment"
                  />
                </div>
                <div className="w-full sm:w-1/2 md:w-1/3">
                  <ModalHeader className="mb-2.5 block text-black dark:text-white">
                    Merk
                  </ModalHeader>
                  <Input
                    value={valueMerk}
                    onChange={onChangeMerk}
                    placeholder="Enter merk"
                  />
                </div>
                <div className="w-full sm:w-1/2 md:w-1/3">
                  <ModalHeader className="mb-2.5 block text-black dark:text-white">
                    Company
                  </ModalHeader>
                  <select value={valueCompany} onChange={onChangeCompany}>
                    <option value="PT Makassar Metro Network">
                      PT Makassar Metro Network
                    </option>
                    <option value="PT Jalan Tol Seksi Empat">
                      PT Jalan Tol Seksi Empat
                    </option>
                  </select>
                </div>
                <div className="w-full sm:w-1/2 md:w-1/3">
                  <ModalHeader className="mb-2.5 block text-black dark:text-white">
                    Picture
                  </ModalHeader>
                  <Input onChange={onChangePicture} type="file" />
                </div>
                <div className="w-full sm:w-1/2 md:w-1/3">
                  <ModalHeader className="mb-2.5 block text-black dark:text-white">
                    Unit
                  </ModalHeader>
                  <Input
                    value={valueStock}
                    onChange={onChangeStock}
                    placeholder="Enter unit"
                    type="number"
                    min="0"
                  />
                </div>
              </div>
            </ModalBody>
            <ModalFooter>
              <Button color="danger" variant="flat" onPress={onClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Add
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

function KategoriModal({
  isOpen,
  onClose,
  onAdd,
  valueduration,
  valuecategory,
  onChangeKategori,
  OnChangeDuration,
}) {
  return (
    <>
      <Modal isOpen={isOpen} onClose={onClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">
              Add Kategori
            </ModalHeader>
            <ModalBody>
              <Input
                autoFocus
                value={valuecategory}
                onChange={onChangeKategori}
                className=" bg-transparent p text-black  transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                label="Kategori"
                placeholder="Enter your kategori"
                variant="bordered"
              />
              <Input
                autoFocus
                value={valueduration}
                onChange={OnChangeDuration}
                className=" bg-transparent p text-black  transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                label="Duration"
                placeholder="Enter duration (e.g., 7 minutes/hours/days/weeks/months)"
                variant="bordered"
              />
            </ModalBody>
            <ModalFooter>
              <Button color="danger" variant="flat" onPress={onClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Add
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

function LokasiModal({ isOpen, onClose, onAdd, value, onChange }) {
  return (
    <>
      <Modal isOpen={isOpen} onClose={onClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="mb-2.5 block text-black dark:text-white">
              Add Lokasi
            </ModalHeader>
            <ModalBody>
              <Input
                autoFocus
                value={value}
                onChange={onChange}
                className=" bg-transparent p text-black  transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                label="Lokasi"
                placeholder="Enter your lokasi"
                variant="bordered"
              />
            </ModalBody>
            <ModalFooter>
              <Button color="danger" variant="flat" onPress={onClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Add
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

function JadwalModal({
  isOpen,
  onClose,
  onAdd,
  onChangeJenisPerusahaan,
  onChangeUraianKegiatan,
  onChangeLokasi,
  onChangeWaktu,
  onChangeFrekuensi,
  onChangeTahun,
  valueLokasi,
  valueJenisPerusahaan,
  valueUraianKegiatan,
  valueWaktu,
  valueFrekuensi,
  valueTahun,
}) {
  const [JadwalOptions, setJadwalOptions] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const res = await getLokasi();
        if (Array.isArray(res)) {
          setJadwalOptions(res);
        } else {
          // Handle incorrect response
          console.error('Invalid response:', res);
        }
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };
    fetchData();
  }, []);

  const renderTanggalInputs = () => {
    if (!valueFrekuensi) return null;
    const jumlahTanggal = parseInt(valueFrekuensi.replace('x pertahun', ''));
    const inputs = [];
    for (let i = 0; i < jumlahTanggal; i++) {
      inputs.push(
        <div key={i} className="flex flex-col gap-2">
          <label htmlFor={`tanggal${i}`} className="text-black">
            Tanggal {i + 1}
          </label>
          <input
            id={`tanggal${i}`}
            type="date"
            value={valueWaktu[i] || ''}
            onChange={(e) => onChangeWaktu(i, e)}
            className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
            placeholder={`Pilih Tanggal ${i + 1}`}
          />
        </div>,
      );
    }
    return inputs;
  };

  return (
    <Modal isOpen={isOpen} onClose={onClose} placement="top-center">
      <ModalContent>
        <ModalHeader className="flex flex-col gap-1">Add Jadwal</ModalHeader>
        <ModalBody>
          <div className="flex flex-col gap-2">
            <div className="flex flex-col gap-2">
              <label htmlFor="jenisPerusahaan" className="text-black">
                Jenis Perusahaan
              </label>
              <select
                id="jenisPerusahaan"
                value={valueJenisPerusahaan}
                onChange={onChangeJenisPerusahaan}
                className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
              >
                <option value="tol">Select Perusahaan</option>
                <option value="tol">Tol</option>
                <option value="non tol">Non Tol</option>
              </select>
            </div>
            <div className="flex flex-col gap-2">
              <label htmlFor="uraianKegiatan" className="text-black">
                Uraian Kegiatan
              </label>
              <textarea
                id="uraianKegiatan"
                value={valueUraianKegiatan}
                onChange={onChangeUraianKegiatan}
                className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                placeholder="Masukkan Uraian Kegiatan"
                rows={3}
              />
            </div>
            <div className="flex flex-col gap-2">
              <label htmlFor="lokasi" className="text-black">
                Lokasi
              </label>
              <select
                value={valueLokasi}
                onChange={onChangeLokasi}
                className="w-full p-2 border rounded"
              >
                <option value="">Select Lokasi</option>
                {JadwalOptions.map((option) => (
                  <option key={option.id} value={option.nama_lokasi}>
                    {option.nama_lokasi}
                  </option>
                ))}
              </select>
            </div>
            <div className="flex flex-col gap-2">
              <label htmlFor="tahun" className="text-black">
                Tahun
              </label>
              <input
                id="tahun"
                type="number"
                value={valueTahun}
                onChange={onChangeTahun}
                className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                placeholder="Masukkan Tahun"
                min="1"
              />
            </div>
            <div className="flex flex-col gap-2">
              <label htmlFor="frekuensi" className="text-black">
                Frekuensi
              </label>
              <select
                id="frekuensi"
                value={valueFrekuensi}
                onChange={onChangeFrekuensi}
                className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
              >
                <option value="">Pilih Frekuensi</option>
                {[...Array(2).keys()].map((i) => (
                  <option key={i} value={`${i + 1}x pertahun`}>{`${
                    i + 1
                  }x pertahun`}</option>
                ))}
              </select>
            </div>
            {renderTanggalInputs()}
          </div>
        </ModalBody>
        <ModalFooter>
          <Button color="danger" variant="flat" onPress={onClose}>
            Close
          </Button>
          <Button color="primary" onPress={onAdd}>
            Add
          </Button>
        </ModalFooter>
      </ModalContent>
    </Modal>
  );
}


export { LokasiModal, KategoriModal, BarangModal, AddStuffModal, JadwalModal };
