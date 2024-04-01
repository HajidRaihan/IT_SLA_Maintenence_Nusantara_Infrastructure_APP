import React, { useState } from 'react';
import {
  Modal,
  ModalContent,
  ModalHeader,
  ModalBody,
  ModalFooter,
  Button,
  useDisclosure,
  RadioGroup,
  Radio,
} from '@nextui-org/react';
import SelectStatus from '../Forms/SelectGroup/SelectStatus';
import { changeStatus } from '../../api/activityApi';

const ChangeStatusModal = ({ isOpen, onOpenChange, id }) => {
  const [status, setStatus] = useState();
  const [kondisiAkhir, setKondisiAkhir] = useState();
  const [fotoAkhir, setFotoAkhir] = useState();

  const changeStatusHandler = async (e) => {
    e.preventDefault();

    const data = {
      status: status,
      kondisi_akhir: kondisiAkhir,
      foto_akhir: fotoAkhir,
    };

    const formData = new FormData();
    formData.append('status', status);
    formData.append('kondisi_akhir', kondisiAkhir);
    formData.append('foto_akhir', fotoAkhir);

    console.log(formData);

    try {
      const res = await changeStatus(formData, id);
      console.log(res);
    } catch (error) {
      console.error(error);
    }
  };

  const statusOnChange = (e) => {
    setStatus(e.target.value);
    console.log(e.target.value);
  };

  const fotoAkhirOnChange = (e) => {
    console.log(e.target.files[0]);
    setFotoAkhir(e.target.files[0]);
  };

  return (
    <>
      <Modal
        className="border-stroke bg-whiter shadow-default dark:border-strokedark dark:bg-black h-[500px] "
        isOpen={isOpen}
        onOpenChange={onOpenChange}
        size="2xl"
      >
        <ModalContent>
          {(onClose) => (
            <>
              <ModalHeader className="dark:text-white flex flex-col gap-1">
                Approve
              </ModalHeader>

              <ModalBody>
                <form action="">
                  <div className="w-full ">
                    <label className="mb-2.5 block text-black dark:text-white">
                      Kondisi Akhir
                    </label>
                    <input
                      type="text"
                      className="w-full rounded border-[1.5px] border-stroke bg-transparent py-3 px-5 text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                      placeholder="Catatan jika diperlukan"
                      value={kondisiAkhir}
                      onChange={(e) => setKondisiAkhir(e.target.value)}
                    />
                  </div>

                  <SelectStatus value={status} onChange={statusOnChange} />

                  <div>
                    <label className="mb-3 block text-black dark:text-white">
                      Foto
                    </label>
                    <input
                      type="file"
                      className="dark:text-white w-full cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:py-3 file:px-5 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary"
                      onChange={fotoAkhirOnChange}
                    />
                  </div>
                </form>
              </ModalBody>

              <ModalFooter>
                <Button
                  color="danger"
                  // onPress={onClose}
                  onClick={changeStatusHandler}
                  className="flex w-full justify-center rounded bg-primary p-3 font-medium text-gray"
                >
                  Tutup
                </Button>
              </ModalFooter>
            </>
          )}
        </ModalContent>
      </Modal>
    </>
  );
};

export default ChangeStatusModal;
