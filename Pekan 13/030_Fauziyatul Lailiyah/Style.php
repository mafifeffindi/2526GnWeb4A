/* RESET */
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* BODY */
body{
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(
        135deg,
        #fff0f5,
        #ffe4ec,
        #fff5f7
    );
    min-height: 100vh;
}

/* LOGIN */
.login-container{
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px;
}

.login-box{
    width: 100%;
    max-width: 350px;
    background: white;
    padding: 35px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(244, 143, 177, 0.2);
    text-align: center;
    border: 1px solid #fbc4d6;
    transition: 0.3s ease;
}

.login-box:hover{
    transform: translateY(-3px);
}

.login-box h2{
    margin-bottom: 5px;
    color: #c2185b;
}

.sub-title{
    color: #880e4f;
    font-size: 14px;
    margin-bottom: 20px;
}

.login-box input{
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #f8bbd0;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
}

.login-box input:focus{
    outline: none;
    border-color: #f06292;
    box-shadow: 0 0 5px rgba(240, 98, 146, 0.4);
}

.login-box button{
    width: 100%;
    padding: 12px;
    background: #f06292;
    border: none;
    color: white;
    border-radius: 8px;
    font-size: 15px;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    box-shadow: 0 4px 10px rgba(240, 98, 146, 0.3);
    transition: all 0.3s ease;
}

.login-box button:hover{
    background: #ec407a;
}

.error{
    background: #ffe4e1;
    color: #c2185b;
    padding: 10px;
    border-radius: 8px;
    margin-bottom: 15px;
    font-size: 14px;
    border: 1px solid #fbc4d6;
}

/* INDEX */
.container{
    width: 95%;
    margin: 30px auto;
}

h2{
    color: #880e4f;
    margin-bottom: 20px;
}

.top-bar{
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.btn{
    text-decoration: none;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    box-shadow: 0 4px 10px rgba(240, 98, 146, 0.3);
    transition: all 0.3s ease;
}

.tambah{
    background: #f06292;
}

.tambah:hover{
    background: #ec407a;
}

.logout{
    background: #ba1a1a;
}

.logout:hover{
    background: #8f1111;
}

/* SEARCH */
.search-box{
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
}

.search-box input{
    flex: 1;
    min-width: 200px;
    padding: 10px;
    border: 1px solid #f8bbd0;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
}

.search-box input:focus{
    outline: none;
    border-color: #f06292;
}

.search-box button{
    padding: 10px 15px;
    background: #f06292;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    transition: all 0.3s ease;
}

.search-box button:hover{
    background: #ec407a;
}

/* TABLE */
.table-container{
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(244, 143, 177, 0.1);
    overflow-x: auto;
    overflow: hidden;
    border: 1px solid #fbc4d6;
    transition: 0.3s ease;
}

.table-container:hover{
    transform: translateY(-3px);
}

table{
    width: 100%;
    border-collapse: collapse;
}

th{
    background: #f06292;
    color: white;
    padding: 14px;
    text-align: center;
    border: 1px solid #f8bbd0;
}

td{
    padding: 12px;
    border: 1px solid #ffe4e1;
    text-align: center;
    color: #494949;
}

tr:hover{
    background: #fff5f7;
}

/* FORM */
.form-container{
    width: 90%;
    max-width: 420px;
    margin: 40px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(244, 143, 177, 0.1);
    border: 1px solid #fbc4d6;
    transition: 0.3s ease;
}

.form-container:hover{
    transform: translateY(-3px);
}

.form-container h2{
    text-align: center;
    margin-bottom: 25px;
    color: #c2185b;
}

.form-container form{
    display: flex;
    flex-direction: column;
}

.form-container label{
    margin-bottom: 6px;
    color: #880e4f;
    font-size: 14px;
    font-weight: 500;
}

.form-container input,
.form-container select,
.form-container textarea{
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #f8bbd0;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
}

.form-container input:focus,
.form-container select:focus,
.form-container textarea:focus{
    outline: none;
    border-color: #f06292;
    box-shadow: 0 0 5px rgba(240, 98, 146, 0.3);
}

.form-container textarea{
    resize: none;
    height: 90px;
}

.button-group{
    display: flex;
    gap: 10px;
}

.form-container button{
    flex: 1;
    background: #f06292;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    box-shadow: 0 4px 10px rgba(240, 98, 146, 0.3);
    transition: all 0.3s ease;
}

.form-container button:hover{
    background: #ec407a;
}

.kembali{
    flex: 1;
    background: #d291bc;
    color: white;
    text-decoration: none;
    padding: 12px;
    border-radius: 8px;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.kembali:hover{
    background: #c17ba7;
}

/* BUTTON AKSI */
.edit-btn{
    background: #f48fb1;
    color: white;
    text-decoration: none;
    padding: 7px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.edit-btn:hover{
    background: #f06292;
}

.hapus-btn{
    background: #ff8a80;
    color: white;
    text-decoration: none;
    padding: 7px 12px;
    border-radius: 6px;
    font-size: 13px;
    margin-left: 5px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.hapus-btn:hover{
    background: #ff5252;
}

/* NOTIFIKASI */
.notif-hapus{
    background: #ffe4e1;
    color: #c2185b;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: center;
    font-size: 14px;
    border: 1px solid #fbc4d6;
    animation: muncul 0.3s ease;
}

/* ANIMASI */
@keyframes muncul{
    from{
        opacity: 0;
        transform: translateY(-10px);
    }
    to{
        opacity: 1;
        transform: translateY(0);
    }
}

/* RESPONSIVE */
@media (max-width: 768px){

    .top-bar{
        flex-direction: column;
        gap: 10px;
    }

    .button-group{
        flex-direction: column;
    }

    .search-box{
        flex-direction: column;
    }

    .search-box input,
    .search-box button{
        width: 100%;
    }

    table{
        font-size: 13px;
    }

    th,
    td{
        padding: 8px;
    }
}
