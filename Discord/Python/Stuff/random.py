import random2
import string

def random_string(length=32):
    character_set = string.ascii_letters + string.digits
    return ''.join(random2.choice(character_set) for i in range(length))

my_random = random_string()

print(my_random)