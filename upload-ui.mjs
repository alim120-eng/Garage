import * as ftp from 'basic-ftp';

const config = {
    host: "ftpupload.net",
    user: "if0_42078692",
    password: "SjNpKLwmeMQFL",
    remoteDir: "/htdocs"
};

async function uploadViews() {
    const client = new ftp.Client();
    try {
        await client.access(config);
        console.log("Connected to FTP");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/resources/views/user/repairs/create.blade.php", "/htdocs/resources/views/user/repairs/create.blade.php");
        console.log("Uploaded repairs/create.blade.php");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/resources/views/user/vehicles/create.blade.php", "/htdocs/resources/views/user/vehicles/create.blade.php");
        console.log("Uploaded vehicles/create.blade.php");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/resources/views/welcome.blade.php", "/htdocs/resources/views/welcome.blade.php");
        console.log("Uploaded welcome.blade.php");

    } catch (err) {
        console.error(err);
    } finally {
        client.close();
    }
}

uploadViews();
