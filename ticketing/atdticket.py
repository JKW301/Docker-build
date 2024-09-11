import mysql.connector
from mysql.connector import Error
import tkinter as tk
from tkinter import messagebox

def create_connection(host_name, user_name, user_password, db_name):

    connection = None
    try:
        connection = mysql.connector.connect(
            host=host_name,
            user=user_name,
            passwd=user_password,
            database=db_name
        )
        print("Connexion à la base de données réussie")
    except Error as e:
        print(f"Erreur : '{e}'")

    return connection

def login(db_conn, username, password):

    cur = db_conn.cursor()
    cur.execute("SELECT * FROM user WHERE name=%s AND password=%s AND status=1", (username, password))
    result = cur.fetchone()
    cur.close()
    return result is not None

def on_login(db_conn, username_entry, password_entry):

    username = username_entry.get()
    password = password_entry.get()
    if login(db_conn, username, password):
        messagebox.showinfo("Connecté", "Connexion réussie")
        create_main_window(db_conn)
    else:
        messagebox.showerror("Erreur", "Connexion refusée")

def create_login_window(db_conn):

    window = tk.Tk()
    window.title("Connexion à ATDtickets")

    tk.Label(window, text="Nom d'utilisateur:").grid(row=0)
    tk.Label(window, text="Mot de passe:").grid(row=1)

    username_entry = tk.Entry(window)
    password_entry = tk.Entry(window, show="*")

    username_entry.grid(row=0, column=1)
    password_entry.grid(row=1, column=1)

    tk.Button(window, text="Connexion", command=lambda: on_login(db_conn, username_entry, password_entry)).grid(row=2, column=1)

    window.mainloop()



def create_main_window(db_conn):
    window = tk.Tk()
    window.title("Tickets")


    frame_non_traites = tk.LabelFrame(window, text="Tickets Non Traites")
    frame_traites = tk.LabelFrame(window, text="Tickets Traites")

    frame_idk = tk.LabelFrame(window, text="Rubrique de test")

    frame_non_traites.grid(row=0, column=0, padx=10, pady=10)
    frame_traites.grid(row=0, column=1, padx=10, pady=10)

    frame_idk.grid(row=0, column=2, padx=10, pady=10)

    list_non_traites = tk.Listbox(frame_non_traites)
    list_traites = tk.Listbox(frame_traites)
    list_idk = tk.Listbox(frame_idk)

    list_idk.pack()

    list_non_traites.pack()
    list_traites.pack()

    def on_ticket_select(event):
        selection = event.widget.curselection()
        if selection:
            index = selection[0]
            title = event.widget.get(index)
            show_ticket_details(title, db_conn)

    list_non_traites.bind('<<ListboxSelect>>', on_ticket_select)

    cur = db_conn.cursor()
    cur.execute("SELECT title FROM ticket WHERE status=0")
    for ticket in cur.fetchall():
        list_non_traites.insert(tk.END, ticket[0])
    
    cur.execute("SELECT title FROM ticket WHERE status=1")
    for ticket in cur.fetchall():
        list_traites.insert(tk.END, ticket[0])
    
    cur.close()

    window.mainloop()

def show_ticket_details(title, db_conn):
    cur = db_conn.cursor()

    cur.execute("SELECT id, content FROM ticket WHERE title=%s", (title,))
    ticket = cur.fetchone()
    cur.close()
    
    if ticket:
        detail_window = tk.Toplevel()
        detail_window.title(title)
        
        tk.Label(detail_window, text="Contenu du Ticket:").pack()
        tk.Label(detail_window, text=ticket[1], wraplength=400).pack()
        
        tk.Button(detail_window, text="Marquer comme traité", command=lambda: update_ticket_status(ticket[0], db_conn, detail_window)).pack()

def update_ticket_status(ticket_id, db_conn, detail_window):
    cur = db_conn.cursor()
    cur.execute("UPDATE ticket SET status=1 WHERE id=%s", (ticket_id,))
    db_conn.commit()
    cur.close()
    
    detail_window.destroy()
    messagebox.showinfo("Ticket traité", "Le ticket a été marqué comme traité.")
    create_main_window(db_conn)  



db_connect = create_connection("127.0.0.1", "root", "root", "atd")
create_login_window(db_connect)