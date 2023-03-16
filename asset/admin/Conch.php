<?php

namespace app\admin\controller;

class Conch extends Base
{
	public function theme()
	{
		if (request()->isPost()) {
			$conch = input();
			$conch["theme"]["fnav"]["ym"] = join("|", $conch["theme"]["fnav"]["ym"]);
			$conch["theme"]["rtnav"]["ym"] = join("|", $conch["theme"]["rtnav"]["ym"]);
			$conch["theme"]["show"]["filter"] = join("|", $conch["theme"]["show"]["filter"]);
			$conch_new["theme"] = $conch["theme"];
			$conch_old = config("hltheme");
			$conch_new = array_merge($conch_old, $conch_new);
			$res = mac_arr2file(APP_PATH . "extra/hltheme.php", $conch_new);
			if ($res === false) {
				return $this->error("保存失败，请重试!");
			} else {
				return $this->success("保存成功!");
			}
		}
		$conch = config("hltheme");
		$this->assign("conch", $conch);
		$this->assign("title", "海螺主题设置");
		return $this->fetch("admin@conch/theme");
	}
}
