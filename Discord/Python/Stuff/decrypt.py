import hashlib

str = hashlib.sha256(b'test')

str_hex = str.hexdigest()

print(str_hex)