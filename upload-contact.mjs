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

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/resources/views/welcome.blade.php", "/htdocs/resources/views/welcome.blade.php");
        console.log("Uploaded welcome.blade.php");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/resources/views/layouts/navigation.blade.php", "/htdocs/resources/views/layouts/navigation.blade.php");
        console.log("Uploaded navigation.blade.php");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/app/Http/Controllers/ContactController.php", "/htdocs/app/Http/Controllers/ContactController.php");
        console.log("Uploaded ContactController.php");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/app/Models/ContactMessage.php", "/htdocs/app/Models/ContactMessage.php");
        console.log("Uploaded ContactMessage.php");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/routes/web.php", "/htdocs/routes/web.php");
        console.log("Uploaded web.php");

        await client.uploadFrom("C:/Users/alim/Desktop/garaje/database/migrations/2026_07_09_130429_create_contact_messages_table.php", "/htdocs/database/migrations/2026_07_09_130429_create_contact_messages_table.php");
        console.log("Uploaded migration");

    } catch (err) {
        console.error(err);
    } finally {
        client.close();
    }
}

uploadViews();
