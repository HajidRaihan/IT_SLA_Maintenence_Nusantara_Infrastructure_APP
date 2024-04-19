import React, { useState } from 'react';
import {
  Modal,
  ModalContent,
  ModalHeader,
  ModalBody,
  ModalFooter,
  Button,
  Input,
  select,
  Dropdown,
  DropdownTrigger,
  DropdownMenu,
  DropdownItem,
} from '@nextui-org/react';

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
  valueNamaKegiatan,
  valueTanggalMulai,
  valueTanggalSelesai,
  valuePerusahaan,
  valueLokasi,
  valueWaktuMulai,
  valueWaktuSelesai,
  onChangeNamaKegiatan,
  onChangeTanggalMulai,
  onChangeTanggalSelesai,
  onChangePerusahaan,
  onChangeLokasi,
  onChangeWaktuMulai,
  onChangeWaktuSelesai,
}) {
  return (
    <>
      <Modal isOpen={isOpen} onClose={onClose} placement="top-center">
        <ModalContent>
          <ModalHeader className="flex flex-col gap-1">Add Jadwal</ModalHeader>
          <ModalBody>
            <div className="flex flex-col gap-4">
              <div className="flex flex-col gap-2">
                <label htmlFor="nama-kegiatan" className="text-black">
                  Nama Kegiatan
                </label>
                <Input
                  id="nama-kegiatan"
                  autoFocus
                  value={valueNamaKegiatan}
                  onChange={onChangeNamaKegiatan}
                  className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                  placeholder="Enter your nama kegiatan"
                  variant="bordered"
                />
              </div>
              <div className="flex flex-col gap-2">
                <label htmlFor="tanggal-mulai" className="text-black">
                  Tanggal Mulai
                </label>
                <Input
                  id="tanggal-mulai"
                  autoFocus
                  value={valueTanggalMulai}
                  onChange={onChangeTanggalMulai}
                  type="date"
                  className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                  placeholder="Select tanggal mulai"
                  variant="bordered"
                />
              </div>
              <div className="flex flex-col gap-2">
                <label htmlFor="tanggal-mulai" className="text-black">
                  Tanggal Selesai
                </label>
                <Input
                  id="tanggal-mulai"
                  autoFocus
                  value={valueTanggalSelesai}
                  onChange={onChangeTanggalSelesai}
                  type="date"
                  className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                  placeholder="Select tanggal mulai"
                  variant="bordered"
                />
              </div>
              <div className="flex flex-col gap-2">
                <label htmlFor="perusahaan" className="text-black">
                  Perusahaan
                </label>
                <select
                  id="perusahaan"
                  value={valuePerusahaan}
                  onChange={onChangePerusahaan}
                  className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                >
                  <option value="">Pilih Perusahaan</option>
                  <option value="PT Makassar Metro Network">
                    PT Makassar Metro Network
                  </option>
                  <option value="PT Jalan Tol Seksi Empat">
                    PT Jalan Tol Seksi Empat
                  </option>
                </select>
              </div>
              <div className="flex flex-col gap-2">
                <label htmlFor="lokasi" className="text-black">
                  Lokasi
                </label>
                <Input
                  id="lokasi"
                  autoFocus
                  value={valueLokasi}
                  onChange={onChangeLokasi}
                  className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                  placeholder="Enter lokasi"
                  variant="bordered"
                />
              </div>
              <div className="flex flex-col gap-2">
                <label htmlFor="waktu-mulai" className="text-black">
                  Waktu Mulai
                </label>
                <Input
                  id="waktu-mulai"
                  autoFocus
                  value={valueWaktuMulai}
                  onChange={onChangeWaktuMulai}
                  type="time"
                  className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                  placeholder="Select waktu mulai"
                  variant="bordered"
                />
              </div>
              <div className="flex flex-col gap-2">
                <label htmlFor="waktu-selesai" className="text-black">
                  Waktu Selesai
                </label>
                <Input
                  id="waktu-selesai"
                  autoFocus
                  value={valueWaktuSelesai}
                  onChange={onChangeWaktuSelesai}
                  type="time"
                  className="bg-transparent text-black transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                  placeholder="Select waktu selesai"
                  variant="bordered"
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
        </ModalContent>
      </Modal>
    </>
  );
}

export { LokasiModal, KategoriModal, BarangModal, AddStuffModal, JadwalModal };
