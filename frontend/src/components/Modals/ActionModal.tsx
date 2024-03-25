import React from 'react';
import {
  Modal,
  ModalContent,
  ModalHeader,
  ModalBody,
  ModalFooter,
  Button,
  useDisclosure,
} from '@nextui-org/react';

const ActionModal = ({ isOpen, onOpenChange, handler }) => {
  return (
    <>
      <Modal
        className="dark:bg-black py-5 flex flex-col items-center"
        isOpen={isOpen}
        onOpenChange={onOpenChange}
        size="sm"
      >
        <ModalContent>
          {(onClose) => (
            <>
              <ModalHeader className="dark:text-white flex flex-col gap-1">
                Apakah anda ingin menghapus activity ini?
              </ModalHeader>

              <ModalFooter>
                <Button color="primary" onPress={onClose}>
                  Tutup
                </Button>
                <Button color="danger" onPress={handler}>
                  Hapus
                </Button>
              </ModalFooter>
            </>
          )}
        </ModalContent>
      </Modal>
    </>
  );
};

export default ActionModal;
