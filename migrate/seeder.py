import psycopg2
from faker import Faker
import random
import os


conn = psycopg2.connect(
    host="localhost",
    database="stopify1",
    user="postgres",
    password="user"
)

cur = conn.cursor()

fake = Faker()





def insert_fake_users(num_users):
    for _ in range(num_users):
        username = fake.user_name()
        email = fake.email()
        password = fake.password()
        role = random.choice(["admin", "user"])
        cur.execute(
            "INSERT INTO users (username, email, password, role) VALUES (%s, %s, %s, %s)",
            (username, email, password, role)
        )
        
        

def insert_fake_artists(num_artists):
    folder_path = os.getcwd() + '/../public/storage/artist_image/'
    artist_images = os.listdir(folder_path)
    for i in range(num_artists):
        name = fake.name()
        image_url = "/storage/artist_image/" + artist_images[i]
        cur.execute(
            "INSERT INTO artist (name, image_url) VALUES (%s, %s)",
            (name, image_url)
        )


def insert_fake_genres(num_genres):
    folder_path = os.getcwd() + '/../public/storage/genre_image/'
    genre_images = os.listdir(folder_path)
    for i in range(len(genre_images)):
        name = genre_images[i][:-4]
        image_url = "/storage/genre_image/" +genre_images[i]
        color = fake.hex_color()
        cur.execute(
            "INSERT INTO genre (name, image_url, color) VALUES (%s, %s, %s)",
            (name, image_url, color)
        )

def insert_fake_albums(num_albums):
    cur = conn.cursor()
    query = "SELECT id_artist from artist;"
    cur.execute(query)
    ids = cur.fetchall()
    
    folder_path = os.getcwd() + '/../public/storage/album_image/'
    album_images = os.listdir(folder_path)
    
    for i in range(num_albums):
        title = fake.sentence()
        id_artist = random.choice(ids)
        image_url = "/storage/album_image/" +  album_images[i]
        cur.execute(
            "INSERT INTO album (title, id_artist, image_url) VALUES (%s, %s, %s)",
            (title, id_artist, image_url)
        )

def insert_fake_music(num_music):
    cur = conn.cursor()
    query1 = "SELECT id_album from album;"
    query2 = "SELECT id_genre from genre;"
    cur.execute(query1)
    id_albums = cur.fetchall()
    cur.execute(query2)
    id_genres = cur.fetchall() 
    
        
    folder_path = os.getcwd() + '/../public/storage/music_audio/'
    music_audios = os.listdir(folder_path)
    
    for i in range(min(num_music, len(music_audios))):
        title = fake.sentence()
        id_genre = random.choice(id_genres)
        audio_url = "/storage/music_audio/" + music_audios[i]
        release_date = fake.date_time()
        id_album = random.choice(id_albums)
        cur.execute(
            "INSERT INTO music (title, id_genre, audio_url, id_album, release_date) VALUES (%s, %s, %s, %s, %s)",
            (title, id_genre, audio_url, id_album, release_date)
        )


def insert_fake_likes(num_likes):
    cur = conn.cursor()
    query1 = "SELECT id_music from music;"
    query2 = "SELECT id_user from users;"
    cur.execute(query1)
    id_musics = cur.fetchall()
    cur.execute(query2)
    id_users = cur.fetchall()
    for _ in range(num_likes):
        id_user = random.choice(id_users)
        id_music = random.choice(id_musics)
        cur.execute(
            "INSERT INTO likes (id_user, id_music) VALUES (%s, %s)",
            (id_user, id_music)
        )
        
def reset(): 
    cur = conn.cursor()
    cur.execute("DELETE FROM users CASCADE")
    cur.execute("DELETE FROM artist CASCADE")
    cur.execute("DELETE FROM genre CASCADE")
    cur.execute("DELETE FROM album CASCADE")
    cur.execute("DELETE FROM music CASCADE")
    cur.execute("DELETE FROM likes CASCADE")


reset()

num_fake_users = 100
num_fake_genres = 20
num_fake_artists = 20
num_fake_albums = 100
num_fake_music = 1000
num_fake_likes = 1000

insert_fake_users(num_fake_users)
insert_fake_genres(num_fake_genres)
insert_fake_artists(num_fake_artists)
insert_fake_albums(num_fake_albums)
insert_fake_music(num_fake_music)
insert_fake_likes(num_fake_likes)



conn.commit()
cur.close()
conn.close()




print ("DB seeded successfuly!")