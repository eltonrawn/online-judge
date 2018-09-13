import java.io.BufferedWriter;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.OutputStreamWriter;

public class Cpp extends Language {
	
	String file, contents, dir;
	int timeout;
	
	public Cpp(String file, int timeout, String contents, String dir) {
		this.file = file;
		this.timeout = timeout;
		this.contents = contents;
		this.dir = dir;
	}
	public void compile() {
		try {
			///creating cpp file
			BufferedWriter out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/" + file + ".cpp")));
			out.write(contents);
			out.close();
			
			///creating error file
			out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/" + file + "err.txt")));
			out.close();
			
			///creating re file
			out = new BufferedWriter(new OutputStreamWriter(new FileOutputStream(dir + "/" + file + "re.txt")));
			out.close();
			///compile cpp code
			
			Runtime r = Runtime.getRuntime();
			
			//String ss = "cmd.exe /k cd \"srcFile\" & cmd.exe /k g++ abc.cpp -o yo 2>abcerr.txt";
			//String ss = "cmd.exe /c cd \"srcFile\" & cmd.exe /c g++ " + file + ".cpp  -o yo 2>" + file + "err.txt";
			String ss = "cmd.exe /c cd \"srcFile\" & cmd.exe /c g++ " + file + ".cpp  -o "+ file + " 2>" + file + "err.txt";
			System.out.println(ss);
			Process p = r.exec(ss);
			p.waitFor();
			
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
	}
	
	public void execute() {
		try {
			// create the execution script
			Runtime r = Runtime.getRuntime();
			///String ss = "cmd.exe /c cd \"srcFile\" & cmd.exe /c " + file + ".exe < "+ file + "in.txt > " + file + "out.txt";
			String ss = "cmd.exe /c cd \"srcFile\" & cmd.exe /c " + file + ".exe < "+ file + "in.txt > " + file + "out.txt & cmd.exe /c echo %ERRORLEVEL% > " + file + "re.txt";
			System.out.println(ss);
			Process p = r.exec(ss);
			
			TimedShell shell = new TimedShell(this, p, timeout);
			shell.start();
			p.waitFor();
			
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		} catch (InterruptedException e) {
			e.printStackTrace();
		}
	}
}
