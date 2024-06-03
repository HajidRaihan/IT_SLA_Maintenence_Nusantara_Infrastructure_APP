import React from "react";
import { Modal, ModalContent, ModalHeader, ModalBody, Button } from "@nextui-org/react";

function VerifiedModal({  isVerifiedOpen,onAdd,onChangeStatus1,valueStatus,onVerifiedClose  }) {
  return (
    <>
      <Modal isOpen={isVerifiedOpen} onClose={onVerifiedClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">Delete Data</ModalHeader>
            <ModalBody>
            <input 
            value={valueStatus}
            onChange={onChangeStatus1}
            />
              <Button color="warning" value={valueStatus}
                >
                Late
              </Button>
              <Button color="danger" value={valueStatus}
              >
                not
              </Button>
              <Button color="secondary" variant="flat" onPress={onVerifiedClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Update
              </Button>
            </ModalBody>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

export default VerifiedModal;
