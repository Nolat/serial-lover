import {
  Box,
  Card,
  Divider,
  Flex,
  HStack,
  Icon,
  Input,
  InputGroup,
  InputLeftElement,
  InputRightElement,
  List,
  ListItem,
  Modal,
  ModalBody,
  ModalContent,
  ModalOverlay,
  Spinner,
  Text,
  Tooltip
} from "@chakra-ui/react";
import { useMutation } from "@tanstack/react-query";
import { ChevronRight, Heart, UserSearch } from "lucide-react";
import { useState } from "react";
import { useNavigate } from "react-router-dom";

import { axios } from "lib/axios";

import { useUserStore } from "../stores/user-store";

const LoginModal: React.FC<LoginModalProps> = ({ isOpen, onClose }) => {
  const { setUser } = useUserStore();

  const [players, setPlayers] = useState<Player[]>([]);

  const navigate = useNavigate();

  const logIn = (player: Player) => {
    setUser(player);
    navigate("/");
  };

  const fetchPlayers = (search: string): Promise<Player[]> =>
    axios.get("api/players", { params: { search } }).then((res) => res.data);

  const { mutate, isPending } = useMutation({
    mutationKey: ["players"],
    mutationFn: fetchPlayers,
    onSuccess: (data) => {
      if (data.length > 4) {
        data = data.slice(0, 4);
      }
      setPlayers(data);
    }
  });

  const onChange: React.ChangeEventHandler<HTMLInputElement> = (e) => {
    e.preventDefault();
    const value = e.target.value;

    mutate(value);
  };

  return (
    <Modal isOpen={isOpen} onClose={onClose}>
      <ModalOverlay />
      <ModalContent m={4} data-testid="login-modal">
        <ModalBody>
          <InputGroup mt={[4, 8]} size="lg" mb={4}>
            <InputLeftElement>
              <UserSearch />
            </InputLeftElement>
            <Input
              placeholder="Qui es-tu ?"
              size="lg"
              autoComplete="name"
              onChange={onChange}
            />
            <InputRightElement>
              <Spinner
                size="sm"
                color="gray.400"
                visibility={isPending ? "visible" : "hidden"}
              />
            </InputRightElement>
          </InputGroup>

          {players.length > 0 && (
            <Box>
              <Divider mb={4} />
              <List>
                {players.map((player) => (
                  <ListItem
                    key={player.id}
                    cursor={player.is_playing ? "not-allowed" : "pointer"}
                    bg={player.is_playing ? "cocoa.100" : "cocoa.200"}
                    _hover={{
                      bg: player.is_playing ? "cocoa.100" : "cocoa.300"
                    }}
                    as={Card}
                    variant="filled"
                    p={4}
                    mb={4}
                    onClick={
                      player.is_playing ? undefined : () => logIn(player)
                    }
                  >
                    <Flex
                      flex={1}
                      gap={4}
                      alignItems="center"
                      flexWrap="wrap"
                      justifyContent="space-between"
                    >
                      <HStack>
                        {player.is_playing && (
                          <Tooltip label="Déjà en jeu">
                            <Icon as={Heart} color="gray.400" />
                          </Tooltip>
                        )}
                        <Text color={player.is_playing ? "gray.400" : "black"}>
                          {player.firstname} {player.lastname}
                        </Text>
                      </HStack>
                      <Icon
                        as={ChevronRight}
                        color={player.is_playing ? "gray.400" : "black"}
                      />
                    </Flex>
                  </ListItem>
                ))}
              </List>
            </Box>
          )}
        </ModalBody>
      </ModalContent>
    </Modal>
  );
};

export default LoginModal;

type LoginModalProps = {
  isOpen: boolean;
  onClose: () => void;
};
