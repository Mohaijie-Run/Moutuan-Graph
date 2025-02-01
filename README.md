## 项目开发原因？

> 本项目仅供学习和参考使用，若因此产生任何问题，我们不承担责任。

我们开发这个项目是为了应对网站图片总量大、加载速度慢的问题。市面上虽然有一些公益免费的图床或小型云存储服务，但它们的稳定性常常难以保障。因此，我们通过直接接入某大厂的图传API接口，提供更加稳定高效的图片云存储解决方案，确保图片上传和加载的速度与可靠性。

## 食用APIの方法？

```html
<form action="./static/lians/ap/upload.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="file" accept="*/*" required />
    <button type="submit">开始上传</button>
</form>

